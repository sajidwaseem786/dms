<x-filament-panels::page>
<style>
    .fi-page-content { row-gap: 0 !important; }

    /* Navigation */
    .week-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }
    .week-nav-btn {
        background: none;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 4px 10px;
        cursor: pointer;
        font-size: 16px;
        color: #374151;
    }
    .week-nav-btn:hover { background: #f9fafb; }
    .week-nav-input {
        padding: 5px 10px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 13px;
        color: #6b7280;
    }

    /* Search */
    .week-search {
        display: flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .week-search input {
        flex: 1;
        padding: 8px 12px;
        border: none;
        outline: none;
        font-size: 13px;
    }
    .week-search button {
        padding: 8px 12px;
        background: none;
        border: none;
        cursor: pointer;
        color: #6b7280;
        border-left: 1px solid #e5e7eb;
    }

    /* Day section */
    .day-section {
        border-bottom: 2px solid #3b82f6;
        margin-bottom: 16px;
        padding-bottom: 0;
    }
    .day-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 15px;
        font-weight: 500;
        color: #374151;
    }
    .day-chat-icon {
        color: #9ca3af;
        font-size: 18px;
    }
    .no-activities {
        font-size: 13px;
        color: #6b7280;
        padding: 6px 0 12px;
    }

    /* Event accordion (same as totaal overzicht) */
    .event-accordion {
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        margin-bottom: 8px;
    }
    .event-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: #fff;
        user-select: none;
    }
    .event-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ef4444;
        color: white;
        font-size: 12px;
        font-weight: 700;
        border-radius: 4px;
        padding: 2px 7px;
        min-width: 36px;
    }
    .event-badge.has-volunteers { background: #22c55e; }
    .event-title-text {
        flex: 1;
        font-size: 14px;
        color: #374151;
        font-weight: 500;
    }
    .event-time {
        font-size: 13px;
        color: #6b7280;
        white-space: nowrap;
    }
    .event-status-badge {
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
    }
    .status-inventarisatie { background: #f97316; color: white; }
    .toggle-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #9ca3af;
        font-size: 20px;
        line-height: 1;
        padding: 0 4px;
        margin-left: auto;
    }

    .dropdown-wrapper { position: relative; flex: 1; }
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 40;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        min-width: 280px;
        padding: 6px 0;
        margin-top: 4px;
    }
    .dropdown-title {
        background: #ef4444;
        color: white;
        font-weight: 700;
        font-size: 14px;
        padding: 8px 14px;
        border-radius: 4px;
        margin: 6px 10px 8px;
    }
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        font-size: 13px;
        color: #374151;
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
    }
    .dropdown-item:hover { background: #f9fafb; }
    .dropdown-item.danger { color: #ef4444; }
    .dropdown-item.success { color: #16a34a; }
    .dropdown-menu.flip-up { top: auto; bottom: 100%; margin-bottom: 4px; }

    /* Tabs */
    .accordion-body { border-top: 1px solid #e5e7eb; background: #fff; }
    .tabs-nav {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        padding: 0 14px;
    }
    .tab-btn {
        padding: 10px 16px;
        font-size: 13px;
        cursor: pointer;
        border: none;
        background: none;
        border-bottom: 2px solid transparent;
        color: #3b82f6;
        margin-bottom: -1px;
    }
    .tab-btn.active {
        border-bottom-color: #111827;
        color: #111827;
        font-weight: 500;
    }
    .tab-content { padding: 16px; }

    /* Volunteers grid */
    .volunteers-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 8px;
        padding: 12px;
    }
    .volunteers-col-header {
        font-weight: 700;
        font-size: 13px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 6px;
    }
    .bevestigd { color: #1d4ed8; }
    .onbevestigd { color: #ea580c; }
    .geannuleerd { color: #9333ea; }
    .afgezegd { color: #6b7280; }
    .volunteer-name { font-size: 13px; padding: 2px 0; }
    .empty-dash { color: #9ca3af; }

    /* Detail table */
    .detail-table { width: 100%; border-collapse: collapse; }
    .detail-table th {
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 12px;
        color: #374151;
    }
    .detail-table td {
        padding: 8px 12px;
        font-size: 13px;
        color: #374151;
        border-top: 1px solid #f3f4f6;
    }
    .detail-table tr:nth-child(odd) td { background: #f9fafb; }
    .detail-table td:first-child {
        font-weight: 500;
        color: #6b7280;
        width: 160px;
    }

    /* Volunteer dropdown */
    .volunteer-clickable { cursor: pointer; }
    .volunteer-clickable:hover { color: #2563eb; text-decoration: underline; }
    .volunteer-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 9999;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        min-width: 220px;
        padding: 6px 0;
        margin-top: 2px;
    }
    .vol-dropdown-title {
        background: #ef4444;
        color: white;
        font-weight: 700;
        font-size: 13px;
        padding: 6px 12px;
        border-radius: 4px;
        margin: 4px 8px 6px;
    }
    .vol-dropdown-item {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        font-size: 12px;
        color: #374151;
        cursor: pointer;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
    }
    .vol-dropdown-item:hover { background: #f9fafb; }
    .vol-dropdown-item.danger { color: #ef4444; }
    .vol-dropdown-item.success { color: #16a34a; }
    .dropdown-divider { border: none; border-top: 1px solid #e5e7eb; margin: 4px 0; }

    /* Page footer */
    .page-footer {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-top: 16px;
        font-size: 12px;
        color: #9ca3af;
    }
</style>

@php
    $weekNumber = $this->getWeekNumber();
    $days = $this->getDays();
@endphp

{{-- Week Navigation (top) --}}
<div class="week-nav">
    <button class="week-nav-btn" wire:click="goToPreviousWeek">←</button>
    <button class="week-nav-btn" wire:click="goToNextWeek">→</button>
    <input type="date"
           class="week-nav-input"
           wire:change="goToDate($event.target.value)"
           placeholder="Ga naar datum:">
</div>

{{-- Week title is handled by $title — override per week --}}
@php
    $weekStart = \Carbon\Carbon::parse($this->currentWeekStart);
    $weekEnd   = $weekStart->copy()->endOfWeek();
@endphp

<div style="font-size:14px; color:#6b7280; margin-bottom:16px;">
    Week {{ $weekNumber }} — {{ $weekStart->format('d M') }} t/m {{ $weekEnd->format('d M Y') }}
</div>

{{-- Days --}}
@foreach($days as $day)
    @php
        $events = $this->getEventsForDay($day);
        $dayLabel = $day->locale('nl')->isoFormat('dddd D MMMM YYYY');
    @endphp

    <div class="day-section">
        <div class="day-header">
            <span>{{ $dayLabel }}</span>
            <span class="day-chat-icon">💬</span>
        </div>

        @if($events->isEmpty())
            <p class="no-activities">Geen activiteiten</p>
        @else
            @foreach($events as $event)
                @php
                    $counts      = $this->getRegistrationCounts($event);
                    $isOpen      = in_array($event->id, $this->openEvents);
                    $activeTab   = $this->activeTabs[$event->id] ?? 'vrijwilligers';
                    $approved    = $event->registrations->where('status', 'approved');
                    $pending     = $event->registrations->where('status', 'pending');
                    $rejected    = $event->registrations->where('status', 'rejected');
                    $timeStr     = substr($event->start_time, 0, 5) . ' - ' . substr($event->end_time, 0, 5);
                    $badgeClass  = $counts['approved'] > 0 ? 'event-badge has-volunteers' : 'event-badge';
                @endphp

                <div class="event-accordion">
                    <div class="event-header">
                        <span>🔒</span>
                        <span>✉</span>
                        <span>⬆</span>

                        <span class="{{ $badgeClass }}">
                            {{ $counts['approved'] }}/{{ $counts['total'] }}
                        </span>

                        <span class="event-time">{{ $timeStr }}</span>

                        @if($event->status === 'draft')
                            <span class="event-status-badge status-inventarisatie">Inventarisatie</span>
                        @endif

                        <div class="dropdown-wrapper" style="flex:1; position:relative;">
                            <button class="event-title-text"
                                    wire:click="toggleDropdown({{ $event->id }})"
                                    style="text-decoration:underline; color:#2563eb; cursor:pointer;">
                                {{ $event->title }}
                            </button>

                            @if($this->openDropdown === $event->id)
                            <div class="dropdown-menu" id="dropdown-{{ $event->id }}">
                                <div class="dropdown-title">{{ $event->title }}</div>
                                <hr class="dropdown-divider">
                                <button class="dropdown-item">✏️ Aanpassen</button>
                                <button class="dropdown-item danger">🗑️ Activiteit verwijderen</button>
                                <hr class="dropdown-divider">
                                <button class="dropdown-item">✉️ Reminder naar vrijwilligers versturen</button>
                                <button class="dropdown-item">✉️ Status reminder NIET verzonden</button>
                                <hr class="dropdown-divider">
                                <button class="dropdown-item success">➕ Vrijwilliger toevoegen</button>
                                <button class="dropdown-item danger">🚫 Vrijwilligers annuleren</button>
                            </div>
                            @endif
                        </div>

                        <button class="toggle-btn"
                                wire:click="toggleEvent({{ $event->id }})">
                            {{ $isOpen ? '−' : '+' }}
                        </button>
                    </div>

                    @if($isOpen)
                    <div class="accordion-body">
                        <div class="tabs-nav">
                            @foreach(['vrijwilligers' => 'Vrijwilligers', 'extra_info' => 'Extra info', 'financien' => 'Financiën', 'rollen' => 'Rollen'] as $tabKey => $tabLabel)
                                <button class="tab-btn {{ $activeTab === $tabKey ? 'active' : '' }}"
                                        wire:click="setTab({{ $event->id }}, '{{ $tabKey }}')">
                                    {{ $tabLabel }}
                                </button>
                            @endforeach
                        </div>

                        <div class="tab-content">
                            @if($activeTab === 'vrijwilligers')
                            <div class="volunteers-grid">
                                <div>
                                    <div class="volunteers-col-header bevestigd">Bevestigd</div>
                                    @forelse($approved as $index => $reg)
                                        <div class="volunteer-dropdown-wrapper" style="position:relative;">
                                            <div class="volunteer-name volunteer-clickable"
                                                 wire:click="toggleVolunteerDropdown({{ $reg->id }})">
                                                {{ ($index + 1) }}. {{ $reg->user->display_name }}
                                            </div>
                                            @if($this->openVolunteerDropdown === $reg->id)
                                                @include('filament.tenant.pages.planning.partials.volunteer-dropdown', ['reg' => $reg])
                                            @endif
                                        </div>
                                    @empty
                                        <span class="empty-dash">-</span>
                                    @endforelse
                                </div>
                                <div>
                                    <div class="volunteers-col-header onbevestigd">Onbevestigd</div>
                                    @forelse($pending as $reg)
                                        <div class="volunteer-dropdown-wrapper" style="position:relative;">
                                            <div class="volunteer-name volunteer-clickable"
                                                 wire:click="toggleVolunteerDropdown({{ $reg->id }})">
                                                {{ $reg->user->display_name }}
                                            </div>
                                            @if($this->openVolunteerDropdown === $reg->id)
                                                @include('filament.tenant.pages.planning.partials.volunteer-dropdown', ['reg' => $reg])
                                            @endif
                                        </div>
                                    @empty
                                        <span class="empty-dash">-</span>
                                    @endforelse
                                </div>
                                <div>
                                    <div class="volunteers-col-header geannuleerd">Geannuleerd</div>
                                    <span class="empty-dash">-</span>
                                </div>
                                <div>
                                    <div class="volunteers-col-header afgezegd">Afgezegd</div>
                                    @forelse($rejected as $reg)
                                        <div class="volunteer-dropdown-wrapper" style="position:relative;">
                                            <div class="volunteer-name volunteer-clickable"
                                                 wire:click="toggleVolunteerDropdown({{ $reg->id }})">
                                                {{ $reg->user->display_name }}
                                            </div>
                                            @if($this->openVolunteerDropdown === $reg->id)
                                                @include('filament.tenant.pages.planning.partials.volunteer-dropdown', ['reg' => $reg])
                                            @endif
                                        </div>
                                    @empty
                                        <span class="empty-dash">-</span>
                                    @endforelse
                                </div>
                            </div>
                            @endif

                            @if($activeTab === 'extra_info')
                            <table class="detail-table">
                                <tr><th>Variabele</th><th>Waarde</th></tr>
                                <tr><td>Bijzonderheden:</td><td>{{ $event->description ?? 'Leeg' }}</td></tr>
                                <tr><td>Adres:</td><td>{{ $event->location ?? 'Leeg' }}</td></tr>
                                <tr><td>Status:</td><td>{{ ucfirst($event->status) }}</td></tr>
                            </table>
                            @endif

                            @if($activeTab === 'financien')
                            @forelse($event->roles as $role)
                            <table class="detail-table" style="margin-bottom:12px;">
                                <tr><th>Variabele</th><th>Waarde</th></tr>
                                <tr><td>Rol:</td><td>{{ $role->role->name ?? '-' }}</td></tr>
                                <tr>
                                    <td>Vergoeding:</td>
                                    <td>{{ match($role->compensation_type) {
                                        'none' => 'Geen vergoeding',
                                        'fixed' => 'Vast bedrag',
                                        'hourly' => 'Per uur',
                                        default => '-'
                                    } }}</td>
                                </tr>
                                @if($role->compensation_type !== 'none')
                                <tr><td>Bedrag:</td><td>€ {{ number_format((float)$role->compensation_amount, 2) }}</td></tr>
                                @endif
                            </table>
                            @empty
                                <p style="color:#6b7280;font-size:13px;">Geen financiële gegevens</p>
                            @endforelse
                            @endif

                            @if($activeTab === 'rollen')
                            <table class="detail-table">
                                <tr><th>Rol</th><th>Aantal</th></tr>
                                @forelse($event->roles as $role)
                                <tr>
                                    <td>{{ $role->role->name ?? '-' }}</td>
                                    <td>{{ $role->required_count }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="2" style="color:#6b7280;">Geen rollen</td></tr>
                                @endforelse
                            </table>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endforeach

{{-- Bottom navigation --}}
<div class="page-footer">
    <button class="week-nav-btn" wire:click="goToPreviousWeek">←</button>
    <button class="week-nav-btn" wire:click="goToNextWeek">→</button>
    <input type="date"
           class="week-nav-input"
           wire:change="goToDate($event.target.value)"
           placeholder="Ga naar datum:">
    <span>Pagina gegenereerd in {{ number_format(microtime(true) - LARAVEL_START, 5) }} seconden.</span>
</div>

<script>
document.addEventListener('click', function(e) {
    if (!e.target.closest('.volunteer-dropdown-wrapper')) {
        Livewire.dispatch('closeVolunteerDropdown');
    }
});
</script>

</x-filament-panels::page>