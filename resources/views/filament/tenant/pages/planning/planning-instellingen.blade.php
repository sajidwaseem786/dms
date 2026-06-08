<x-filament-panels::page>
<style>
    .settings-table { width: 100%; border-collapse: collapse; }
    .settings-table th {
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .settings-table td {
        padding: 14px 16px;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: top;
    }
    .settings-table tr:nth-child(even) td { background: #fafafa; }
    .settings-table td.label-col {
        font-weight: 500;
        color: #374151;
        width: 280px;
    }
    .settings-table td.value-col {
        color: #4b5563;
        white-space: pre-line;
    }
    .settings-table td.action-col {
        width: 60px;
        text-align: right;
    }
    .edit-icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #6b7280;
        font-size: 16px;
        padding: 4px;
    }
    .edit-icon-btn:hover { color: #2563eb; }
</style>

<div style="border-top: 3px solid #3b82f6; border-radius: 4px; overflow: hidden;
            border: 1px solid #e5e7eb;">
    <table class="settings-table">
        <thead>
            <tr>
                <th>Variabele</th>
                <th>Waarde</th>
                <th style="text-align:right;">Wijzigen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->getRows() as $row)
                <tr>
                    <td class="label-col">{{ $row['label'] }}</td>
                    <td class="value-col">{{ $this->getDisplayValue($row['variable']) ?: '—' }}</td>
                    <td class="action-col">
                        <button class="edit-icon-btn"
                                wire:click="selectAndEdit('{{ $row['variable'] }}', '{{ $row['type'] }}')"
                                title="Wijzigen">
                            ✏️
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<x-filament-actions::modals />
</x-filament-panels::page>