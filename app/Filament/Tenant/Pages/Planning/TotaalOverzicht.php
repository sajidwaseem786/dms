<?php

namespace App\Filament\Tenant\Pages\Planning;

use App\Jobs\SendEventReminderJob;
use App\Models\Event;
use App\Models\User;
use App\Models\VolunteerRegistration;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class TotaalOverzicht extends Page
{
    protected static ?string $title = 'Planning totaal overzicht';
    protected static ?string $navigationLabel = 'Totaal overzicht';
    protected static string|\UnitEnum|null $navigationGroup = 'Planning';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static ?int $navigationSort = 3;

    public ?int $openDropdown = null;
    public ?int $selectedEventId = null;

    protected $listeners = ['closeDropdown'];

    protected string $view = 'filament.tenant.pages.planning.totaal-overzicht';

    public array $openEvents = [];
    public array $activeTabs = [];

    public function toggleEvent(int $eventId): void
    {
        if (in_array($eventId, $this->openEvents)) {
            $this->openEvents = array_filter(
                $this->openEvents,
                fn($id) => $id !== $eventId
            );
        } else {
            $this->openEvents[] = $eventId;
            if (!isset($this->activeTabs[$eventId])) {
                $this->activeTabs[$eventId] = 'vrijwilligers';
            }
        }
    }

    public function toggleDropdown(int $eventId): void
    {
        $this->openDropdown = $this->openDropdown === $eventId ? null : $eventId;
    }

    public function closeDropdown(): void
    {
        $this->openDropdown = null;
    }

    public function setTab(int $eventId, string $tab): void
    {
        $this->activeTabs[$eventId] = $tab;
    }

    // ── Edit Event Action ──────────────────────────────────────
    public function editEventAction(): Action
    {
        return Action::make('editEvent')
            ->label('Aanpassen')
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('title')
                        ->label('Titel')
                        ->required(),
                    TextInput::make('location')
                        ->label('Locatie')
                        ->required(),
                ]),
                Grid::make(2)->schema([
                    DatePicker::make('start_date')
                        ->label('Startdatum')
                        ->required()
                        ->native(false)
                        ->displayFormat('d/m/Y'),
                    TimePicker::make('start_time')
                        ->label('Starttijd')
                        ->required(),
                ]),
                Grid::make(2)->schema([
                    DatePicker::make('end_date')
                        ->label('Einddatum')
                        ->required()
                        ->native(false)
                        ->displayFormat('d/m/Y'),
                    TimePicker::make('end_time')
                        ->label('Eindtijd')
                        ->required(),
                ]),
                Textarea::make('description')
                    ->label('Beschrijving')
                    ->rows(3),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
                        'closed'    => 'Closed',
                    ])
                    ->required(),
            ])
            ->fillForm(function (): array {
                if (!$this->selectedEventId) return [];
                $event = Event::find($this->selectedEventId);
                return $event ? $event->toArray() : [];
            })
            ->action(function (array $data): void {
                if (!$this->selectedEventId) return;
                Event::find($this->selectedEventId)?->update($data);
                $this->openDropdown = null;
                Notification::make()
                    ->title('Activiteit bijgewerkt')
                    ->success()
                    ->send();
            });
    }

    // ── Delete Event Action ────────────────────────────────────
    public function deleteEventAction(): Action
    {
        return Action::make('deleteEvent')
            ->label('Activiteit verwijderen')
            ->requiresConfirmation()
            ->modalHeading('Activiteit verwijderen')
            ->modalDescription('Weet je zeker dat je deze activiteit wilt verwijderen? Dit kan niet ongedaan worden gemaakt.')
            ->modalSubmitActionLabel('Ja, verwijderen')
            ->color('danger')
            ->action(function (): void {
                if (!$this->selectedEventId) return;
                Event::find($this->selectedEventId)?->delete();
                $this->openDropdown  = null;
                $this->selectedEventId = null;
                Notification::make()
                    ->title('Activiteit verwijderd')
                    ->success()
                    ->send();
            });
    }

    // ── Add Volunteer Action ───────────────────────────────────
    public function addVolunteerAction(): Action
    {
        return Action::make('addVolunteer')
            ->label('Vrijwilliger toevoegen')
            ->schema([
                Select::make('user_id')
                    ->label('Vrijwilliger')
                    ->options(fn() => User::orderBy('first_name')
                        ->get()
                        ->mapWithKeys(fn($u) => [
                            $u->id => trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) ?: $u->name
                        ]))
                    ->searchable()
                    ->required(),
                Select::make('preference')
                    ->label('Voorkeur rol')
                    ->options(fn() => \App\Models\VolunteerRole::pluck('name', 'id'))
                    ->searchable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Onbevestigd',
                        'approved' => 'Bevestigd',
                        'rejected' => 'Afgezegd',
                    ])
                    ->default('pending')  // ✅ default to pending like reference site
                    ->required(),
            ])
            ->action(function (array $data): void {
                if (!$this->selectedEventId) return;

                VolunteerRegistration::updateOrCreate(
                    [
                        'event_id' => $this->selectedEventId,
                        'user_id'  => $data['user_id'],
                    ],
                    [
                        'preference' => $data['preference'] ?? 1,
                        'status'     => $data['status'],
                        'remarks'    => null,
                    ]
                );

                $this->openDropdown = null;

                // ✅ Force page data to refresh
                $this->dispatch('$refresh');

                Notification::make()
                    ->title('Vrijwilliger toegevoegd')
                    ->success()
                    ->send();
            });
    }

    

    // ── Cancel All Volunteers Action ───────────────────────────
    public function cancelVolunteersAction(): Action
    {
        return Action::make('cancelVolunteers')
            ->label('Vrijwilligers annuleren')
            ->requiresConfirmation()
            ->modalHeading('Vrijwilligers annuleren')
            ->modalDescription('Weet je zeker dat je alle vrijwilligers voor deze activiteit wilt annuleren?')
            ->modalSubmitActionLabel('Ja, annuleren')
            ->color('danger')
            ->action(function (): void {
                if (!$this->selectedEventId) return;
                VolunteerRegistration::where('event_id', $this->selectedEventId)
                    ->update(['status' => 'rejected']);
                $this->openDropdown = null;
                Notification::make()
                    ->title('Vrijwilligers geannuleerd')
                    ->success()
                    ->send();
            });
    }

    // ── Send Reminder Action ───────────────────────────────────
    public function sendReminderAction(): Action
    {
        return Action::make('sendReminder')
            ->label('Reminder versturen')
            ->modalHeading('Reminder sturen')
            ->schema([
                \Filament\Forms\Components\TextInput::make('subject')
                    ->label('Onderwerp')
                    ->default(function (): string {
                        if (!$this->selectedEventId) return '';
                        $event = Event::find($this->selectedEventId);
                        if (!$event) return '';
                        $date = $event->start_date->format('l j F Y');
                        return "Reminder: {$date} - {$event->title}";
                    })
                    ->required(),
                \Filament\Forms\Components\RichEditor::make('body')
                    ->label('Bericht')
                    ->default(function (): string {
                        if (!$this->selectedEventId) return '';
                        $event = Event::find($this->selectedEventId);
                        if (!$event) return '';
                        $approved = $event->registrations()
                            ->where('status', 'approved')
                            ->with('user')
                            ->get();
                        $volunteerList = $approved->map(fn($r, $i) =>
                            ($i + 1) . '. ' . $r->user->display_name
                        )->join('<br>');
                        return "
                            <p>Beste vrijwilligers,</p>
                            <p>Bedankt voor jullie inschrijving!</p>
                            <table>
                                <tr><td>Inschrijving:</td><td>{$event->title}</td></tr>
                                <tr><td>Datum:</td><td>{$event->start_date->format('Y-m-d')}</td></tr>
                                <tr><td>Tijd:</td><td>" . substr($event->start_time, 0, 5) . " - " . substr($event->end_time, 0, 5) . "</td></tr>
                            </table>
                            <p><strong>Vrijwilligers:</strong><br>{$volunteerList}</p>
                            <p>Met vriendelijke groet,<br>Het planningsteam</p>
                        ";
                    })
                    ->required()
                    ->columnSpanFull(),
            ])
            ->action(function (array $data): void {
                if (!$this->selectedEventId) return;

                $event = Event::with(['registrations.user'])->find($this->selectedEventId);
                if (!$event) return;

                // ✅ Get current tenant ID
                $tenantId = tenancy()->tenant->getTenantKey();

                $volunteers = $event->registrations->where('status', 'approved');
                $queuedCount = 0;

                foreach ($volunteers as $registration) {
                    $user = $registration->user;
                    if (!$user || !$user->email) continue;

                    // ✅ Pass IDs and tenant, not model instances
                    SendEventReminderJob::dispatch(
                        tenantId: $tenantId,
                        eventId: $event->id,
                        volunteerId: $user->id,
                        emailSubject: $data['subject'],
                        body: $data['body'],
                    );

                    $queuedCount++;
                }

                $event->update(['reminder_sent' => true]);
                $this->openDropdown = null;

                Notification::make()
                    ->title("Reminder in wachtrij voor {$queuedCount} vrijwilliger(s)")
                    ->success()
                    ->send();
            });
    }

    // ── Toggle Reminder Status Action ─────────────────────────
    public function toggleReminderStatusAction(): Action
    {
        return Action::make('toggleReminderStatus')
            ->label('Status reminder wijzigen')
            ->requiresConfirmation()
            ->modalHeading(function (): string {
                if (!$this->selectedEventId) return 'Status wijzigen';
                $event = Event::find($this->selectedEventId);
                return 'Status wijzigen naar reminder ' .
                    ($event?->reminder_sent ? 'NIET verzonden' : 'verzonden') .
                    ' voor activiteit: ' . ($event?->title ?? '');
            })
            ->modalSubmitActionLabel('OK')
            ->action(function (): void {
                if (!$this->selectedEventId) return;
                $event = Event::find($this->selectedEventId);
                if (!$event) return;

                $event->update(['reminder_sent' => !$event->reminder_sent]);
                $this->openDropdown = null;

                Notification::make()
                    ->title('Reminder status bijgewerkt')
                    ->success()
                    ->send();
            });
    }

    public function getEvents(): Collection
    {
        return Event::with([
            'roles.role',
            'registrations' => function($query) {
                $query->with('user')->latest();
            },
        ])
        ->orderBy('start_date')
        ->get();
    }

    public function getRegistrationCounts(Event $event): array
    {
        $approved = $event->registrations->where('status', 'approved')->count();
        $total    = $event->roles->sum('required_count');
        return ['approved' => $approved, 'total' => $total];
    }

    public function selectAndEdit(int $eventId): void
    {
        $this->selectedEventId = $eventId;
        $this->openDropdown = null;
        $this->mountAction('editEvent');
    }

    public function selectAndDelete(int $eventId): void
    {
        $this->selectedEventId = $eventId;
        $this->openDropdown = null;
        $this->mountAction('deleteEvent');
    }

    public function selectAndAddVolunteer(int $eventId): void
    {
        $this->selectedEventId = $eventId;
        $this->openDropdown = null;
        $this->mountAction('addVolunteer');
    }

    public function selectAndCancel(int $eventId): void
    {
        $this->selectedEventId = $eventId;
        $this->openDropdown = null;
        $this->mountAction('cancelVolunteers');
    }

    public function selectAndSendReminder(int $eventId): void
    {
        $this->selectedEventId = $eventId;
        $this->openDropdown = null;
        $this->mountAction('sendReminder');
    }

    public function selectAndToggleReminderStatus(int $eventId): void
    {
        $this->selectedEventId = $eventId;
        $this->openDropdown = null;
        $this->mountAction('toggleReminderStatus');
    }
}