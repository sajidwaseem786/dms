<?php

namespace App\Filament\Tenant\Resources\VolunteerRegistrations\Pages;

use App\Filament\Tenant\Resources\VolunteerRegistrations\VolunteerRegistrationResource;
use App\Models\Event;
use App\Models\VolunteerRegistration;
use App\Models\VolunteerRole;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Livewire\Attributes\On;

class VolunteerRegistrationsEnroll extends Page
{
    protected static string $resource = VolunteerRegistrationResource::class;
    protected static ?string $title = 'Inschrijven voor aankomende activiteiten';

    protected string $view = 'filament.tenant.resources.volunteer-registrations.pages.volunteer-registrations-enroll';

    // ── Livewire properties bound to the modal form ──
    public ?int   $selectedEventId  = null;
    public ?int   $preferenceRoleId = null;
    public string $remark           = '';

    // ── Open modal: set the selected event ──
    #[On('open-event-modal')]
    public function openEventModal(int $eventId): void
    {
        $this->selectedEventId  = $eventId;
        $this->preferenceRoleId = null;
        $this->remark           = '';
    }

    // ── Save registration ──
    public function register(): void
    {
        $user  = auth()->user();
        $event = Event::findOrFail($this->selectedEventId);

        VolunteerRegistration::create([
            'event_id'           => $this->selectedEventId,
            'user_id'            => $user->id,
            'preference'  => $this->preferenceRoleId,
            'remarks'             => $this->remark ?: null,
            'status'             => 'approved',
        ]);

        // Close modal via JS event
        $this->dispatch('close-event-modal');

        Notification::make()
            ->title('Registration successful')
            ->body('You have been registered for "' . $event->title . '".')
            ->success()
            ->send();

        // Reset form
        $this->selectedEventId  = null;
        $this->preferenceRoleId = null;
        $this->remark           = '';
    }

    // ── Data helpers ──
    public function getScheduleData(): array
    {
        $events = Event::query()
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        $weekGroups = [];

        foreach ($events as $event) {
            $startDate    = Carbon::parse($event->start_date);
            $weekNumber   = 'Week ' . str_pad($startDate->format('W'), 2, '0', STR_PAD_LEFT);
            $dateFormatted = $startDate->format('l, F j, Y');
            $color = match ($event->registrations()->value('status')) {
                'pending'  => 'orange',
                'approved' => 'green',
                'rejected' => 'red',
                default    => 'blue',
            };

            $time = $event->start_time && $event->end_time
                ? Carbon::parse($event->start_time)->format('H:i') . ' - ' . Carbon::parse($event->end_time)->format('H:i')
                : 'All Day';

            // Check if current user is already registered
            $isRegistered = VolunteerRegistration::query()
                ->where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->exists();

            // Classified (approved) volunteers for this event
            $classifiedVolunteers = VolunteerRegistration::query()
                ->where('event_id', $event->id)
                ->where('status', 'approved')
                ->with('user')
                ->get()
                ->map(fn($r) => $r->user->name)
                ->toArray();

            $eventData = [
                'id'                   => $event->id,
                'time'                 => $time,
                'title'                => $event->title,
                'description'          => $event->description,
                'color'                => $color,
                'status'               => $event->status,
                'roles'                => $event->roles,
                'isRegistered'         => $isRegistered,
                'classifiedVolunteers' => $classifiedVolunteers,
                'canRegister'          => !$isRegistered && $event->status !== 'rejected',
            ];

            $weekGroups[$weekNumber][$dateFormatted][] = $eventData;
        }

        $scheduleData = [];
        foreach ($weekGroups as $weekNumber => $dates) {
            $days = [];
            foreach ($dates as $date => $events) {
                $days[] = ['date' => $date, 'events' => $events];
            }
            $scheduleData[] = ['week' => $weekNumber, 'days' => $days];
        }

        return $scheduleData;
    }

    public function getUserVolunteerRoles(): array
    {
        return auth()->user()
            ->volunteerJobRoles()
            ->select('volunteer_roles.id', 'volunteer_roles.name')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getUserVolunteerRoleNames(): array
    {
        return auth()->user()
            ->volunteerJobRoles()
            ->pluck('name')
            ->toArray();
    }

    public function getVolunteerTypeNameById(int $id): string
    {
        return VolunteerRole::find($id)?->name ?? 'Unknown';
    }
}
