<x-filament-panels::page>
    @push('styles')
    <style>
        .info-banner {
            position: relative;
            background: #06b6d4;
            border-radius: 8px;
            padding: 16px 20px;
            color: white;
        }
        .info-banner .close-btn {
            position: absolute;
            top: 10px;
            right: 14px;
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            line-height: 1;
        }
        .info-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .info-icon {
            background: white;
            color: #06b6d4;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
            flex-shrink: 0;
        }
        .info-title {
            font-weight: 600;
            font-size: 15px;
            margin: 0;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        .details-table thead tr {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
        }
        .details-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #374151;
        }
        .details-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }
        .details-table tbody tr:last-child {
            border-bottom: none;
        }
        .details-table tbody tr:nth-child(odd) {
            background: #f9fafb;
        }
        .details-table tbody tr:nth-child(even) {
            background: #ffffff;
        }
        .details-table td {
            padding: 10px 16px;
            font-size: 14px;
            color: #374151;
            vertical-align: top;
        }
        .details-table td:first-child {
            font-weight: 500;
            color: #6b7280;
            width: 220px;
            white-space: nowrap;
        }
        .edit-link {
            color: #3b82f6;
            text-decoration: underline;
            cursor: pointer;
            font-size: 14px;
            background: none;
            border: none;
            padding: 0;
        }
    </style>
    @endpush

    {{-- Info Banner --}}
    <div class="info-banner">
        <button class="close-btn" onclick="this.parentElement.style.display='none'">×</button>
        <div class="info-header">
            <span class="info-icon">i</span>
            <h2 class="info-title">Ter info</h2>
        </div>
        <p style="margin:0; font-size:14px;">Pas wijzigingen zo snel mogelijk aan!</p>
    </div>

    {{-- Edit Button --}}
    <div>
        {{ $this->editAction }}
        <x-filament::modal />
    </div>

    {{-- Details Table --}}
    @php $user = Auth::user(); @endphp
    <table class="details-table">
        <thead>
            <tr>
                <th>Variabele</th>
                <th>Waarde</th>
            </tr>
        </thead>
        <tbody>
            @foreach([
                'Voornaam'                   => $user->first_name,
                'Achternaam'                 => $user->last_name,
                'Geslacht'                   => match($user->gender ?? '') {
                    'male' => 'Man', 'female' => 'Vrouw', 'other' => 'Anders', default => '-'
                },
                'Geboortedatum'              => $user->birth_date?->format('d-m-Y'),
                'Straat'                     => $user->street,
                'Huisnummer'                 => $user->house_number,
                'Postcode'                   => $user->postal_code,
                'Woonplaats'                 => $user->city,
                'Land'                       => $user->country,
                'E-mailadres'                => $user->email,
                'Telefoonnummer'             => $user->phone,
                'IBAN'                       => $user->iban,
                'Beschrijving (smoelenboek)' => $user->smoelenboek_description,
                'BIG-/EHBO-nummer'           => $user->big_ehbo,
                'BIG/EHBO geldig tot'        => $user->big_ehbo_valid_until?->format('d-m-Y'),
                'Rijbewijs'                  => $user->has_license ? 'Ja' : 'Nee',
            ] as $label => $value)
            <tr>
                <td>{{ $label }}:</td>
                <td>{{ $value ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-filament-panels::page>