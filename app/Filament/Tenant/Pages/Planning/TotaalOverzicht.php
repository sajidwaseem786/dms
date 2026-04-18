<?php

namespace App\Filament\Tenant\Pages\Planning;

use App\Models\Event;
use BackedEnum;
use Filament\Pages\Page;
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
    protected $listeners = ['closeDropdown'];
    protected string $view = 'filament.tenant.pages.planning.totaal-overzicht';

    // Track which event accordion is open
    public array $openEvents = [];

    // Track active tab per event
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

    public function getEvents(): Collection
    {
        return Event::with([
            'roles.role',
            'registrations.user',
        ])
        ->orderBy('start_date')
        ->get();
    }

    public function getRegistrationCounts(Event $event): array
    {
        $registrations = $event->registrations;
        $approved = $registrations->where('status', 'approved')->count();
        $total = $event->roles->sum('required_count');

        return [
            'approved' => $approved,
            'total'    => $total,
        ];
    }
}