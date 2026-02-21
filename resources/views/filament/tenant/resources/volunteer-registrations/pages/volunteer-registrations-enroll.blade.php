<x-filament-panels::page>
        @push('styles')
        <link rel="stylesheet" href="{{ asset('css/filament/filament/volunteer_registration.css') }}">
    @endpush

    {{-- ════════════════════════════════════════ --}}
    {{-- Info Banner                              --}}
    {{-- ════════════════════════════════════════ --}}
    <div class="info-banner">
        <button class="close-btn" onclick="this.parentElement.style.display='none'">×</button>
        <div class="info-header">
            <span class="info-icon">ℹ</span>
            <h2 class="info-title">For your information</h2>
        </div>
        <div class="info-content">
            <p>If you would like to report a change, please send an email to
                <span class="underline">planning@dutchmedicalservice.nl</span></p>
            <p>Registration is always possible</p>
            <div class="activity-row"><span class="activity-badge badge-blue">Blue activities</span><span>are open for registration.</span></div>
            <div class="activity-row"><span class="activity-badge badge-green">Green activities</span><span>are registered activities (approved).</span></div>
            <div class="activity-row"><span class="activity-badge badge-orange">Orange activities</span><span>have not yet been confirmed by the organization (pending).</span></div>
            <div class="activity-row"><span class="activity-badge badge-red">Red activities</span><span>are closed for registration or rejected.</span></div>
            <div class="activity-row"><span class="activity-badge badge-purple">Purple activities</span><span>are trainings.</span></div>
        </div>
    </div>

    {{-- ════════════════════════════════════════ --}}
    {{-- Schedule                                 --}}
    {{-- ════════════════════════════════════════ --}}
    <div class="schedule-container">
        @forelse($this->getScheduleData() as $weekIndex => $week)
            <div class="week-section">
                <div class="week-header">{{ $week['week'] }}</div>

                @foreach($week['days'] as $day)
                    <div class="day-header">{{ $day['date'] }}</div>

                    @forelse($day['events'] as $event)
                        {{-- Event card — calls Livewire to open modal --}}
                        <div class="event-card event-{{ $event['color'] }}"
                             wire:click="openEventModal({{ $event['id'] }})"
                             title="Click to view details">
                            <div class="event-time">{{ $event['time'] }}</div>
                            <div class="event-title">{{ $event['title'] }}</div>
                        </div>
                    @empty
                        <p class="empty-state">No events scheduled</p>
                    @endforelse
                @endforeach
            </div>
            @if(!$loop->last)<div class="divider"></div>@endif
        @empty
            <p class="empty-state">No Activiteiten!</p>
        @endforelse
    </div>

    {{-- ════════════════════════════════════════ --}}
    {{-- Single shared modal (Livewire-driven)    --}}
    {{-- ════════════════════════════════════════ --}}
    @if($selectedEventId)
        @php
            // Flatten schedule data to find the selected event
            $selectedEvent = null;
            $selectedDate  = null;
            foreach($this->getScheduleData() as $week) {
                foreach($week['days'] as $day) {
                    foreach($day['events'] as $ev) {
                        if($ev['id'] === $selectedEventId) {
                            $selectedEvent = $ev;
                            $selectedDate  = $day['date'];
                            break 3;
                        }
                    }
                }
            }
        @endphp

        @if($selectedEvent)
        <div class="modal-overlay active" id="mainModalOverlay"
             onclick="if(event.target===this) @this.call('closeModal')">
            <div class="modal">

                {{-- Header --}}
                <div class="modal-header">
                    <h2>{{ $selectedDate }}, {{ $selectedEvent['time'] }}</h2>
                    <p>{{ $selectedEvent['title'] }}</p>
                    @if($selectedEvent['description'])
                        <p>{{ $selectedEvent['description'] }}</p>
                    @endif
                    <button class="modal-close" wire:click="$set('selectedEventId', null)">×</button>
                </div>

                {{-- Body --}}
                <div class="modal-body">

                    {{-- Volunteers needed --}}
                    <div class="info-card">
                        <div class="info-card-title"><span>ℹ</span> Volunteers needed</div>
                        @foreach($selectedEvent['roles'] as $role)
                            <div class="info-card-subtitle">{{ $role->role->name ?? $role->name }}</div>
                            <div class="open-for-label">Open for:</div>
                            <ul>
                                @foreach($role->volunteer_type_ids ?? [] as $volunteerTypeId)
                                    @php $typeName = $this->getVolunteerTypeNameById($volunteerTypeId); @endphp
                                    <li>
                                        {{ $typeName }}
                                        @if(in_array($typeName, $this->getUserVolunteerRoleNames()))
                                            <span class="check-icon">✔</span>
                                            <span class="job-tag">(your job category)</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>

                    {{-- Already registered --}}
                    @if($selectedEvent['isRegistered'])
                        <div class="status-card green">
                            <div class="status-card-header"><span>✔</span> Already registered for activity</div>
                        </div>
                    @endif

                    {{-- Classified volunteers --}}
                    @if(count($selectedEvent['classifiedVolunteers']) > 0)
                        <div class="status-card green2">
                            <div class="status-card-header"><span>✔</span> Classified volunteers</div>
                            <ul>
                                @foreach($selectedEvent['classifiedVolunteers'] as $volunteerName)
                                    <li>{{ $volunteerName }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Preference select — bound via wire:model --}}
                    @if($selectedEvent['canRegister'])
                    <div class="form-group">
                        <label class="form-label" for="preferenceSelect">Preference</label>
                        <select class="form-select" id="preferenceSelect"
                                wire:model="preferenceRoleId">
                            <option value="">No preference</option>
                            @foreach($this->getUserVolunteerRoles() as $roleId => $roleName)
                                <option value="{{ $roleId }}">{{ $roleName }}</option>
                            @endforeach
                        </select>
                        @error('preferenceRoleId')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Remark textarea — bound via wire:model --}}
                    <div class="form-group">
                        <label class="form-label" for="remarkTextarea">Remark:</label>
                        <textarea class="form-textarea" id="remarkTextarea"
                                  wire:model="remark"
                                  placeholder="Enter your remark here..."></textarea>
                        @error('remark')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button class="btn btn-close"
                            wire:click="$set('selectedEventId', null)">Close</button>

                    @if($selectedEvent['canRegister'])
                        <button class="btn btn-register"
                                wire:click="register"
                                wire:loading.attr="disabled"
                                wire:loading.class="btn-disabled">
                            <span wire:loading.remove wire:target="register">Register</span>
                            <span wire:loading wire:target="register">Saving…</span>
                        </button>
                    @else
                        <button class="btn btn-disabled" disabled>Registration not possible</button>
                    @endif
                </div>

            </div>
        </div>
        @endif
    @endif

    {{-- ESC key closes modal --}}
    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                @this.set('selectedEventId', null);
            }
        });
    </script>
</x-filament-panels::page>
