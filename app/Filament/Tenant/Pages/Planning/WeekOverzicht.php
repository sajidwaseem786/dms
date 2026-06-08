<?php

namespace App\Filament\Tenant\Pages\Planning;

use App\Models\Event;
use App\Models\VolunteerRegistration;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class WeekOverzicht extends Page
{
    protected static ?string $title       = 'Planning week overzicht';
    protected static ?string $navigationLabel = 'Week overzicht';
    protected static string|\UnitEnum|null $navigationGroup = 'Planning';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.tenant.pages.planning.week-overzicht';

    public string $currentWeekStart = '';
    public array $openEvents    = [];
    public array $activeTabs    = [];
    public ?int $openDropdown   = null;
    public ?int $openVolunteerDropdown = null;
    public ?int $selectedEventId       = null;
    public ?int $selectedRegistrationId = null;

    protected $listeners = ['closeDropdown', 'closeVolunteerDropdown'];

    public function mount(): void
    {
        $this->currentWeekStart = Carbon::now()->startOfWeek()->toDateString();
    }

    public function goToPreviousWeek(): void
    {
        $this->currentWeekStart = Carbon::parse($this->currentWeekStart)
            ->subWeek()->toDateString();
        $this->openEvents = [];
        $this->activeTabs = [];
    }

    public function goToNextWeek(): void
    {
        $this->currentWeekStart = Carbon::parse($this->currentWeekStart)
            ->addWeek()->toDateString();
        $this->openEvents = [];
        $this->activeTabs = [];
    }

    public function goToDate(string $date): void
    {
        try {
            $this->currentWeekStart = Carbon::parse($date)
                ->startOfWeek()->toDateString();
            $this->openEvents = [];
            $this->activeTabs = [];
        } catch (\Exception $e) {
            // Invalid date — do nothing
        }
    }

    public function getWeekNumber(): int
    {
        return Carbon::parse($this->currentWeekStart)->weekOfYear;
    }

    public function getDays(): array
    {
        $start = Carbon::parse($this->currentWeekStart);
        $days  = [];

        for ($i = 0; $i < 7; $i++) {
            $days[] = $start->copy()->addDays($i);
        }

        return $days;
    }

    public function getEventsForDay(Carbon $day): Collection
    {
        return Event::with([
            'roles.role',
            'registrations' => fn($q) => $q->with('user')->latest(),
        ])
        ->whereDate('start_date', $day->toDateString())
        ->orderBy('start_time')
        ->get();
    }

    public function toggleEvent(int $eventId): void
    {
        if (in_array($eventId, $this->openEvents)) {
            $this->openEvents = array_filter(
                $this->openEvents, fn($id) => $id !== $eventId
            );
        } else {
            $this->openEvents[] = $eventId;
            if (!isset($this->activeTabs[$eventId])) {
                $this->activeTabs[$eventId] = 'vrijwilligers';
            }
        }
    }

    public function setTab(int $eventId, string $tab): void
    {
        $this->activeTabs[$eventId] = $tab;
    }

    public function toggleDropdown(int $eventId): void
    {
        $this->openDropdown = $this->openDropdown === $eventId ? null : $eventId;
    }

    public function closeDropdown(): void
    {
        $this->openDropdown = null;
    }

    public function toggleVolunteerDropdown(int $registrationId): void
    {
        $this->openVolunteerDropdown = $this->openVolunteerDropdown === $registrationId
            ? null : $registrationId;
    }

    public function closeVolunteerDropdown(): void
    {
        $this->openVolunteerDropdown = null;
    }

    public function getRegistrationCounts(Event $event): array
    {
        return [
            'approved' => $event->registrations->where('status', 'approved')->count(),
            'total'    => $event->roles->sum('required_count'),
        ];
    }

    public function emailVolunteer(int $registrationId): void
    {
        $this->openVolunteerDropdown = null;
        // For now redirect to totaal overzicht for full email functionality
        $this->redirect(route('filament.tenant.pages.totaal-overzicht'));
    }

    public function cancelVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['status' => 'rejected']);
        $this->openVolunteerDropdown = null;
    }

    public function confirmVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['status' => 'approved']);
        $this->openVolunteerDropdown = null;
    }

    public function afzeggenVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['status' => 'rejected']);
        $this->openVolunteerDropdown = null;
    }

    public function removeVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->delete();
        $this->openVolunteerDropdown = null;
    }

    public function editRegistration(int $registrationId): void
    {
        $this->openVolunteerDropdown = null;
    }

    // ── Simple actions (no modal needed) ──────────────────────
    public function unconfirmVolunteer(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['status' => 'pending']);
        $this->openVolunteerDropdown = null;
    }

    public function makeCoordinator(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['is_coordinator' => true]);
        $this->openVolunteerDropdown = null;
    }

    public function cancelCoordinator(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['is_coordinator' => false]);
        $this->openVolunteerDropdown = null;
    }

    public function confirmAttendance(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['attendance' => 'present']);
        $this->openVolunteerDropdown = null;
    }

    public function confirmAbsence(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['attendance' => 'absent']);
        $this->openVolunteerDropdown = null;
    }

    public function cancelAttendance(int $registrationId): void
    {
        VolunteerRegistration::find($registrationId)?->update(['attendance' => 'none']);
        $this->openVolunteerDropdown = null;
    }
}