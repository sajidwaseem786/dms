@php use Illuminate\Support\Facades\Storage; @endphp

<x-filament-panels::page>

    {{-- Show current photo if exists --}}
    @php $photo = Auth::user()->profile_photo; @endphp
    @if($photo)
        <div>
            <img src="{{ Storage::disk('public')->url($photo) }}"
                 alt="Profielfoto"
                 style="width: 200px; height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb;">
        </div>
    @endif

    <p style="font-size: 13px; color: #6b7280;">
        Maximum grootte: 2 MB. Alleen .jpeg, .jpg, .png, .gif toegestaan (Let op, geen hoofdletters! Dus geen foto.JPG)<br>
        De afmetingen van de foto wordt automatisch aangepast, de grootte niet.
    </p>

    <form wire:submit="save">
        {{ $this->form }}
        <div style="margin-top: 12px;">
            <x-filament::button type="submit">
                Uploaden
            </x-filament::button>
        </div>
    </form>

</x-filament-panels::page>