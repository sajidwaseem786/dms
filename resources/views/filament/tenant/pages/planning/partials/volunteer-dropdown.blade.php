<div class="volunteer-dropdown">
    <div class="vol-dropdown-title">{{ $reg->user->display_name }}</div>
    <hr class="dropdown-divider">

    {{-- Section 1: Status --}}
    <button class="vol-dropdown-item success"
            wire:click="confirmVolunteer({{ $reg->id }})">
        ➤ Bevestigen
    </button>
    <button class="vol-dropdown-item danger"
            wire:click="cancelVolunteer({{ $reg->id }})">
        ✖ Annuleren
    </button>
    <button class="vol-dropdown-item"
            wire:click="afzeggenVolunteer({{ $reg->id }})">
        ➖ Afzeggen
    </button>
    <button class="vol-dropdown-item"
            wire:click="unconfirmVolunteer({{ $reg->id }})">
        ↩ On-bevestigen
    </button>

    <hr class="dropdown-divider">

    {{-- Section 2: Attendance --}}
    <button class="vol-dropdown-item"
            wire:click="confirmAttendance({{ $reg->id }})">
        ⊙ Aanwezigheid bevestigen
    </button>
    <button class="vol-dropdown-item"
            wire:click="confirmAbsence({{ $reg->id }})">
        ○ Afwezigheid bevestigen
    </button>
    <button class="vol-dropdown-item"
            wire:click="cancelAttendance({{ $reg->id }})">
        ● Aan-/afwezigheid annuleren
    </button>
    <button class="vol-dropdown-item danger"
            wire:click="removeVolunteer({{ $reg->id }})">
        🗑 Aanmelding verwijderen
    </button>

    <hr class="dropdown-divider">

    {{-- Section 3: Coordinator --}}
    <button class="vol-dropdown-item"
            wire:click="makeCoordinator({{ $reg->id }})">
        ☆ Coördinator maken
    </button>
    <button class="vol-dropdown-item"
            wire:click="cancelCoordinator({{ $reg->id }})">
        ★ Coördinator annuleren
    </button>

    <hr class="dropdown-divider">

    {{-- Section 4: Email --}}
    <button class="vol-dropdown-item"
            wire:click="emailVolunteer({{ $reg->id }})">
        ✉ E-mailen
    </button>

    <hr class="dropdown-divider">

    {{-- Section 5: Edit --}}
    <button class="vol-dropdown-item"
            wire:click="editRegistration({{ $reg->id }})">
        ✎ Inschrijving aanpassen
    </button>
</div>