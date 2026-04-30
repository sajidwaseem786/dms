<x-filament-panels::page>
<style>
    .fi-page-content { row-gap: 20px !important; }
    .event-accordion {
        border: 1px solid #e5e7eb;
        border-radius: 6px;
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
        color: #2563eb;
        cursor: pointer;
        text-decoration: underline;
        background: none;
        border: none;
        text-align: left;
        padding: 0;
    }
    .event-title-text:hover { color: #1d4ed8; }
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
    .toggle-btn:hover { color: #374151; }

    /* Dropdown */
    .dropdown-wrapper {
        position: relative;
        flex: 1;
        display: inline-block; /* ensures clean positioning */
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 9999;
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

    .dropdown-divider {
        border: none;
        border-top: 1px solid #e5e7eb;
        margin: 4px 0;
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

    /* Flip-up class (used by JS) */
    .dropdown-menu.flip-up {
        top: auto;
        bottom: 100%;
        margin-bottom: 4px;
    }

    /* Accordion body */
    .accordion-body {
        border-top: 1px solid #e5e7eb;
        background: #fff;
    }
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
    .section-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #111827;
    }
</style>

<div class="section-title">Alle activiteiten</div>

@php $events = $this->getEvents(); @endphp

@forelse($events as $event)
    @php
        $counts    = $this->getRegistrationCounts($event);
        $isOpen    = in_array($event->id, $this->openEvents);
        $activeTab = $this->activeTabs[$event->id] ?? 'vrijwilligers';
        $approved  = $event->registrations->where('status', 'approved');
        $pending   = $event->registrations->where('status', 'pending');
        $rejected  = $event->registrations->where('status', 'rejected');
        $dateStr   = $event->start_date->format('d-m-Y')
            . ' ' . substr($event->start_time, 0, 5)
            . ' - ' . substr($event->end_time, 0, 5);
        $badgeClass     = $counts['approved'] > 0 ? 'event-badge has-volunteers' : 'event-badge';
        $dropdownOpen   = $this->openDropdown === $event->id;
    @endphp

    <div class="event-accordion">
        {{-- Accordion Header --}}
        <div class="event-header">
            {{-- Icons --}}
            <span title="Status">🔒</span>
            <span title="Mail">✉</span>
            <span title="Export">⬆</span>

            {{-- Count badge --}}
            <span class="{{ $badgeClass }}">
                {{ $counts['approved'] }}/{{ $counts['total'] }}
            </span>

            {{-- Date & Time --}}
            <span class="event-time">{{ $dateStr }}</span>

            {{-- Status badge --}}
            @if($event->status === 'draft')
                <span class="event-status-badge status-inventarisatie">Inventarisatie</span>
            @endif

            {{-- Clickable title with dropdown --}}
            <div class="dropdown-wrapper">
                <button class="event-title-text"
                        wire:click="toggleDropdown({{ $event->id }})">
                    {{ $event->title }}
                </button>

                @if($dropdownOpen)
                <div id="dropdown-{{ $event->id }}" class="dropdown-menu">
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

            {{-- Toggle button (ONLY this toggles accordion) --}}
            <button class="toggle-btn"
                    wire:click="toggleEvent({{ $event->id }})">
                {{ $isOpen ? '−' : '+' }}
            </button>
        </div>

        {{-- Accordion Body --}}
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
                            <div class="volunteer-name">{{ ($index + 1) }}. {{ $reg->user->first_name }} {{ $reg->user->last_name }}</div>
                        @empty
                            <span class="empty-dash">-</span>
                        @endforelse
                    </div>
                    <div>
                        <div class="volunteers-col-header onbevestigd">Onbevestigd</div>
                        @forelse($pending as $reg)
                            <div class="volunteer-name">{{ $reg->user->first_name }} {{ $reg->user->last_name }}</div>
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
                            <div class="volunteer-name">{{ $reg->user->first_name }} {{ $reg->user->last_name }}</div>
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
@empty
    <p style="color:#6b7280;font-size:14px;">Geen activiteiten gevonden.</p>
@endforelse

{{-- Spacer + page info --}}
<div style="
    min-height: 260px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
    font-size: 12px;
    color: #9ca3af;
">
    Pagina gegenereerd in {{ number_format(microtime(true) - LARAVEL_START, 5) }} seconden.
</div>

<script>
function adjustDropdown() {
    const menu = document.querySelector('.dropdown-menu');
    if (!menu) return;

    // Reset to default (below)
    menu.style.top = '100%';
    menu.style.bottom = 'auto';
    menu.classList.remove('flip-up');

    const rect = menu.getBoundingClientRect();
    const viewportHeight = window.innerHeight;

    // If it overflows the bottom of the screen → flip upward
    if (rect.bottom > viewportHeight + 10) {   // +10px tolerance
        menu.style.top = 'auto';
        menu.style.bottom = '100%';
        menu.classList.add('flip-up');
    }
}

// Run after every Livewire update (when dropdown opens/closes)
document.addEventListener('livewire:update', adjustDropdown);
document.addEventListener('livewire:commit', () => setTimeout(adjustDropdown, 30));

// Also handle window resize (e.g. mobile orientation change)
window.addEventListener('resize', adjustDropdown);

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    // If no dropdown is open, do nothing
    const menu = document.querySelector('.dropdown-menu');
    if (!menu) return;

    // If the click was inside a dropdown-wrapper, do nothing (Livewire handles it)
    if (e.target.closest('.dropdown-wrapper')) return;

    // Otherwise, close the dropdown via Livewire
    Livewire.dispatch('closeDropdown');
});
</script>

</x-filament-panels::page>