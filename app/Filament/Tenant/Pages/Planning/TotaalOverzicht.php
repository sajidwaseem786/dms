<?php

namespace App\Filament\Tenant\Pages\Planning;

use App\Jobs\SendEventReminderJob;
use App\Models\Event;
use App\Models\User;
use App\Models\VolunteerRegistration;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
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

    public ?int $openVolunteerDropdown = null;
    public ?int $selectedRegistrationId = null;

    protected $listeners = ['closeDropdown', 'closeVolunteerDropdown'];

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

    // Volunteer dropdown menu
    public function toggleVolunteerDropdown(int $registrationId): void
    {
        $this->openVolunteerDropdown = $this->openVolunteerDropdown === $registrationId
            ? null
            : $registrationId;
    }

    public function confirmVolunteerAction(): Action
    {
        return Action::make('confirmVolunteer')
            ->label('Bevestigen')
            ->modalHeading('Vrijwilliger bevestigen')
            ->schema([
                \Filament\Forms\Components\TextInput::make('subject')
                    ->label('Onderwerp')
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';
                        $date = $reg->event->start_date->format('l j F Y');
                        return "Bevestiging: {$date} - {$reg->event->title}";
                    })
                    ->required(),
                \Filament\Forms\Components\Textarea::make('body')
                    ->label('Bericht')
                    ->rows(10)
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';
                        $name = $reg->user->display_name;
                        $date = $reg->event->start_date->format('l j F Y');
                        $time = substr($reg->event->start_time, 0, 5) . ' - ' . substr($reg->event->end_time, 0, 5);
                        $remark = $reg->remarks ?? '(geen opmerking ingevoerd)';
                        return "Beste {$name},\n\nJe inschrijving voor onderstaande activiteit is DEFINITIEF bevestigd:\n\nInschrijving: {$reg->event->title}\nDatum: {$date} {$time}\nJouw opmerking: {$remark}\n\nMeer informatie volgt t.z.t. via het draaiboek.\n\nMet vriendelijke groet,\nHet planningsteam van stichting Dutch Medical Service";
                    })
                    ->columnSpanFull(),
            ])
            ->extraModalFooterActions([
                Action::make('confirmWithoutEmail')
                    ->label('Bevestigen zonder e-mail')
                    ->color('danger')
                    ->action(function (): void {
                        if (!$this->selectedRegistrationId) return;
                        VolunteerRegistration::find($this->selectedRegistrationId)
                            ?->update(['status' => 'approved']);
                        $this->openVolunteerDropdown = null;
                        Notification::make()->title('Vrijwilliger bevestigd')->success()->send();
                    }),
            ])
            ->modalSubmitActionLabel('Bevestigen met e-mail')
            ->action(function (array $data): void {
                if (!$this->selectedRegistrationId) return;
                $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                if (!$reg) return;

                $reg->update(['status' => 'approved']);

                if ($reg->user->email) {
                    \App\Jobs\SendEventReminderJob::dispatch(
                        tenantId: tenancy()->tenant->getTenantKey(),
                        eventId: $reg->event_id,
                        volunteerId: $reg->user_id,
                        emailSubject: $data['subject'],
                        body: nl2br($data['body']),
                    );
                }

                $this->openVolunteerDropdown = null;
                Notification::make()->title('Vrijwilliger bevestigd en e-mail verzonden')->success()->send();
            });
    }

    public function unconfirmVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['status' => 'pending']);
        $this->openVolunteerDropdown = null;
        Notification::make()->title('Vrijwilliger onbevestigd')->success()->send();
    }

    // ── Cancel Volunteer Action ────────────────────────────────
    public function cancelVolunteerAction(): Action
    {
        return Action::make('cancelVolunteer')
            ->label('Annuleren')
            ->modalHeading('Vrijwilliger annuleren')
            ->schema([
                \Filament\Forms\Components\TextInput::make('subject')
                    ->label('Onderwerp')
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';
                        $date = $reg->event->start_date->format('l j F Y');
                        return "Annulering: {$date} - {$reg->event->title}";
                    })
                    ->required(),
                \Filament\Forms\Components\Textarea::make('body')
                    ->label('Bericht')
                    ->rows(10)
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';
                        $name = $reg->user->display_name;
                        $date = $reg->event->start_date->format('l j F Y');
                        return "Beste {$name},\n\nJe hebt je opgegeven voor de activiteit:\n\nInschrijving: {$reg->event->title}\nDatum: {$date}\n\nHelaas ben je niet ingedeeld voor deze activiteit.\n\nDesalniettemin zijn wij jou dankbaar voor je beschikbaarheid.\n\nMet vriendelijke groet,\nHet planningsteam van stichting Dutch Medical Service";
                    })
                    ->columnSpanFull(),
            ])
            ->extraModalFooterActions([
                Action::make('cancelWithoutEmail')
                    ->label('Annuleren zonder e-mail')
                    ->color('danger')
                    ->action(function (): void {
                        if (!$this->selectedRegistrationId) return;
                        VolunteerRegistration::find($this->selectedRegistrationId)
                            ?->update(['status' => 'rejected']);
                        $this->openVolunteerDropdown = null;
                        Notification::make()->title('Vrijwilliger geannuleerd')->success()->send();
                    }),
            ])
            ->modalSubmitActionLabel('Annuleren met e-mail')
            ->action(function (array $data): void {
                if (!$this->selectedRegistrationId) return;
                $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                if (!$reg) return;

                $reg->update(['status' => 'rejected']);

                if ($reg->user->email) {
                    \App\Jobs\SendEventReminderJob::dispatch(
                        tenantId: tenancy()->tenant->getTenantKey(),
                        eventId: $reg->event_id,
                        volunteerId: $reg->user_id,
                        emailSubject: $data['subject'],
                        body: nl2br($data['body']),
                    );
                }

                $this->openVolunteerDropdown = null;
                Notification::make()->title('Vrijwilliger geannuleerd en e-mail verzonden')->success()->send();
            });
    }

    // ── Afzeggen Action ────────────────────────────────────────
    public function afzeggenVolunteerAction(): Action
    {
        return Action::make('afzeggenVolunteer')
            ->label('Afzeggen')
            ->modalHeading('Vrijwilliger afzeggen')
            ->schema([
                \Filament\Forms\Components\TextInput::make('subject')
                    ->label('Onderwerp')
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';
                        $date = $reg->event->start_date->format('l j F Y');
                        return "Verwerking afmelding: {$date} - {$reg->event->title}";
                    })
                    ->required(),
                \Filament\Forms\Components\Textarea::make('body')
                    ->label('Bericht')
                    ->rows(10)
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';
                        $name = $reg->user->display_name;
                        $date = $reg->event->start_date->format('l j F Y');
                        return "Beste {$name},\n\nWe hebben jouw afmelding voor de volgende activiteit verwerkt:\n\nInschrijving: {$reg->event->title}\nDatum: {$date}\n\nMet vriendelijke groet,\nHet planningsteam van stichting Dutch Medical Service";
                    })
                    ->columnSpanFull(),
            ])
            ->extraModalFooterActions([
                Action::make('afzeggenWithoutEmail')
                    ->label('Afzeggen zonder e-mail')
                    ->color('danger')
                    ->action(function (): void {
                        if (!$this->selectedRegistrationId) return;
                        VolunteerRegistration::find($this->selectedRegistrationId)
                            ?->update(['status' => 'rejected']);
                        $this->openVolunteerDropdown = null;
                        Notification::make()->title('Vrijwilliger afgezegd')->success()->send();
                    }),
            ])
            ->modalSubmitActionLabel('Afzeggen met e-mail')
            ->action(function (array $data): void {
                if (!$this->selectedRegistrationId) return;
                $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                if (!$reg) return;

                $reg->update(['status' => 'rejected']);

                if ($reg->user->email) {
                    \App\Jobs\SendEventReminderJob::dispatch(
                        tenantId: tenancy()->tenant->getTenantKey(),
                        eventId: $reg->event_id,
                        volunteerId: $reg->user_id,
                        emailSubject: $data['subject'],
                        body: nl2br($data['body']),
                    );
                }

                $this->openVolunteerDropdown = null;
                Notification::make()->title('Vrijwilliger afgezegd en e-mail verzonden')->success()->send();
            });
    }

    public function removeVolunteerAction(): Action
    {
        return Action::make('removeVolunteer')
            ->label('Aanmelding verwijderen')
            ->modalHeading('Aanmelding verwijderen?')
            ->modalDescription(fn () => 
                $this->selectedRegistrationId 
                    ? 'Weet je zeker dat je de aanmelding van ' . 
                    VolunteerRegistration::find($this->selectedRegistrationId)?->user?->display_name . 
                    ' wilt verwijderen?' 
                    : ''
            )
            ->modalSubmitActionLabel('OK')
            ->color('danger')
            ->requiresConfirmation() // optional extra safety
            ->action(function (): void {
                if (!$this->selectedRegistrationId) return;

                VolunteerRegistration::find($this->selectedRegistrationId)?->delete();

                $this->openVolunteerDropdown = null;
                $this->dispatch('$refresh');

                Notification::make()
                    ->title('Aanmelding verwijderd')
                    ->success()
                    ->send();
            });
    }

    public function selectAndConfirmVolunteer(int $registrationId): void
    {
        $this->selectedRegistrationId = $registrationId;
        $this->openVolunteerDropdown = null;
        $this->mountAction('confirmVolunteer');
    }

    public function selectAndCancelVolunteer(int $registrationId): void
    {
        $this->selectedRegistrationId = $registrationId;
        $this->openVolunteerDropdown = null;
        $this->mountAction('cancelVolunteer');
    }

    public function selectAndAfzeggenVolunteer(int $registrationId): void
    {
        $this->selectedRegistrationId = $registrationId;
        $this->openVolunteerDropdown = null;
        $this->mountAction('afzeggenVolunteer');
    }

    public function removeVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->delete();
        $this->openVolunteerDropdown = null;
        Notification::make()->title('Vrijwilliger verwijderd')->success()->send();
    }

    public function selectAndRemoveVolunteer(int $registrationId): void
    {
        $this->selectedRegistrationId = $registrationId;
        $this->openVolunteerDropdown = null;
        $this->mountAction('removeVolunteer');
    }

    public function closeVolunteerDropdown(): void
    {
        $this->openVolunteerDropdown = null;
    }

    public function makeCoordinator(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['is_coordinator' => true]);
        $this->openVolunteerDropdown = null;
        Notification::make()->title('Coördinator gemaakt')->success()->send();
    }

    public function cancelCoordinator(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['is_coordinator' => false]);
        $this->openVolunteerDropdown = null;
        Notification::make()->title('Coördinator geannuleerd')->success()->send();
    }

    public function confirmAttendance(int $registrationId): void
    {
        $reg = VolunteerRegistration::with('user')->find($registrationId);
        $name = $reg?->user->display_name ?? '';

        // Use JS confirm - already works
        VolunteerRegistration::find($registrationId)?->update(['attendance' => 'present']);
        $this->openVolunteerDropdown = null;
        Notification::make()->title("Aanwezigheid van {$name} bevestigd")->success()->send();
    }

    public function confirmAbsence(int $registrationId): void
    {
        $reg = VolunteerRegistration::with('user')->find($registrationId);
        $name = $reg?->user->display_name ?? '';

        VolunteerRegistration::find($registrationId)?->update(['attendance' => 'absent']);
        $this->openVolunteerDropdown = null;
        Notification::make()->title("Afwezigheid van {$name} bevestigd")->success()->send();
    }

    public function cancelAttendance(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['attendance' => 'none']);
        $this->openVolunteerDropdown = null;
        Notification::make()->title('Aan-/afwezigheid geannuleerd')->success()->send();
    }

    public function emailVolunteerAction(): Action
    {
        return Action::make('emailVolunteer')
            ->label('E-mailen')
            ->modalHeading('E-mail versturen')
            ->schema([
                TextInput::make('subject')
                    ->label('Onderwerp')
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return 'Bericht betreffende een activiteit';
                        
                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return 'Bericht betreffende een activiteit';

                        $date = $reg->event->start_date->format('l j F Y');
                        return "Bericht betreffende: {$date} - {$reg->event->title}";
                    })
                    ->required(),

                RichEditor::make('body')
                    ->label('Bericht')
                    ->default(function (): string {
                        if (!$this->selectedRegistrationId) return '';

                        $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                        if (!$reg) return '';

                        $name = $reg->user->display_name ?? 'Vrijwilliger';
                        $date = $reg->event->start_date->format('l j F Y');
                        $time = substr($reg->event->start_time ?? '', 0, 5) . ' - ' . substr($reg->event->end_time ?? '', 0, 5);
                        $remark = $reg->remarks ?? '(geen opmerking ingevoerd)';

                        return <<<HTML
                        <p>Beste {$name},</p>
                        <p>Onderstaand bericht betreft de volgende activiteit:</p>
                        <p><strong>Inschrijving:</strong> {$reg->event->title}</p>
                        <p><strong>Datum:</strong> {$date}</p>
                        <p><strong>Tijd:</strong> {$time}</p>
                        <p><strong>Jouw opmerking:</strong> {$remark}</p>
                        <hr>
                        <p>---TEKST HIER---</p>
                        <br>
                        <p>Met vriendelijke groet,<br>
                        Het planningsteam van stichting Dutch Medical Service</p>
    HTML;
                    })
                    ->columnSpanFull()
                    ->required(),
            ])
            ->action(function (array $data): void {
                if (!$this->selectedRegistrationId) return;

                $reg = VolunteerRegistration::with(['user', 'event'])->find($this->selectedRegistrationId);
                if (!$reg || !$reg->user?->email) return;

                \App\Jobs\SendEventReminderJob::dispatch(
                    tenantId: tenancy()->tenant->getTenantKey(),
                    eventId: $reg->event_id,
                    volunteerId: $reg->user_id,
                    emailSubject: $data['subject'],
                    body: $data['body'],
                );

                $this->openVolunteerDropdown = null;
                Notification::make()->title('E-mail verzonden')->success()->send();
            });
    }

    public function editRegistrationAction(): Action
    {
        return Action::make('editRegistration')
            ->label('Inschrijving aanpassen')
            ->schema([
                \Filament\Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Onbevestigd',
                        'approved' => 'Bevestigd',
                        'rejected' => 'Afgezegd',
                    ])
                    ->required(),
                \Filament\Forms\Components\Select::make('preference')
                    ->label('Voorkeur rol')
                    ->options(fn() => \App\Models\VolunteerRole::pluck('name', 'id'))
                    ->searchable(),
                \Filament\Forms\Components\Textarea::make('remarks')
                    ->label('Opmerking')
                    ->rows(3),
            ])
            ->fillForm(function (): array {
                if (!$this->selectedRegistrationId) return [];
                $reg = VolunteerRegistration::find($this->selectedRegistrationId);
                return $reg ? $reg->toArray() : [];
            })
            ->action(function (array $data): void {
                if (!$this->selectedRegistrationId) return;
                VolunteerRegistration::find($this->selectedRegistrationId)?->update($data);
                $this->openVolunteerDropdown = null;
                Notification::make()->title('Inschrijving bijgewerkt')->success()->send();
            });
    }

    public function selectAndEmailVolunteer(int $registrationId): void
    {
        $this->selectedRegistrationId = $registrationId;
        $this->openVolunteerDropdown = null;
        $this->mountAction('emailVolunteer');
    }

    public function selectAndEditRegistration(int $registrationId): void
    {
        $this->selectedRegistrationId = $registrationId;
        $this->openVolunteerDropdown = null;
        $this->mountAction('editRegistration');
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
        ->whereDate('start_date', '>=', Carbon::today())
        ->orderBy('start_date')
        ->orderBy('start_time')  
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