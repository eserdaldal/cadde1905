<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">Widget Kontrol</x-slot>
        <x-slot name="description">
            Widget kayıtları + geçersiz kılma tablosu birleşimi. Superadmin değiştirir.
            Admin salt okunur, Editör erişemez.
        </x-slot>

        @if (! $this->canEdit())
            <div class="mb-4 rounded-md border border-amber-200 bg-amber-50 p-3 text-sm text-amber-800">
                Salt okunur mod: Bu sayfada değişiklik yapma izniniz yok.
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                    <tr class="border-b text-left text-xs uppercase tracking-wide text-gray-500">
                        <th class="py-2 pr-4">Widget</th>
                        <th class="py-2 pr-4">Yaşam Döngüsü</th>
                        <th class="py-2 pr-4">Varsayılan Öncelik</th>
                        <th class="py-2 pr-4">Geçersiz Kılma Önceliği</th>
                        <th class="py-2 pr-4">Etkin Öncelik</th>
                        <th class="py-2 pr-4">Varsayılan Aktiflik</th>
                        <th class="py-2 pr-4">Geçersiz Kılma Aktifliği</th>
                        <th class="py-2 pr-4">Etkin Aktiflik</th>
                        <th class="py-2 pr-4">Geçersiz Kılma</th>
                        <th class="py-2 pr-4">Notlar</th>
                        <th class="py-2 pr-4">İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($rows as $index => $row)
                        @php
                            $canEdit = $this->canEdit();
                            $isEditable = $row['is_editable'] ?? false;
                            $isDisabled = (! $canEdit) || (! $isEditable);
                            $resetDisabled = ! ($row['override_exists'] ?? false);
                            $readonlyKeys = ['on-this-day', 'dynamic-campaign', 'join-community'];
                            $lifecycleLabels = [
                                'always_on' => 'Her zaman aktif',
                                'seasonal' => 'Kampanya',
                                'data_aware' => 'Veriye bağlı',
                                'dormant' => 'Pasif',
                            ];
                            $lifecycleLabel = $lifecycleLabels[$row['lifecycle']] ?? $row['lifecycle'];
                            $isReadOnlyRow = in_array($row['key'] ?? '', $readonlyKeys, true);
                        @endphp
                        <tr @class([
                            'border-b align-top',
                            'bg-gray-50' => $isReadOnlyRow,
                            'hover:bg-slate-50/70' => ! $isReadOnlyRow,
                        ])>
                            <td class="py-2 pr-4">
                                <div class="font-semibold text-gray-900">{{ $row['key'] }}</div>
                                <div class="text-xs text-gray-500">{{ $row['component'] }}</div>
                                @if ($isReadOnlyRow)
                                    <div class="mt-1">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-gray-200 text-gray-700 rounded">
                                            🔒 Salt okunur
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="py-2 pr-4 text-gray-700">
                                <div class="inline-flex items-center rounded bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-700">
                                    {{ $lifecycleLabel }}
                                </div>
                            </td>
                            <td class="py-2 pr-4 text-gray-700">{{ $row['default_priority'] }}</td>
                            <td class="py-2 pr-4">
                                <input
                                    type="number"
                                    @class([
                                        'w-28 rounded-md border border-gray-300 px-2 py-1 text-sm',
                                        'transition focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-400 hover:border-gray-400' => ! $isReadOnlyRow,
                                        'opacity-100',
                                        'bg-gray-100 text-gray-500 cursor-not-allowed' => $isReadOnlyRow,
                                    ])
                                    wire:model.defer="rows.{{ $index }}.override_priority"
                                    @disabled($isDisabled || $isReadOnlyRow)
                                />
                            </td>
                            <td class="py-2 pr-4 text-gray-700">{{ $row['effective_priority'] }}</td>
                            <td class="py-2 pr-4 text-gray-700">{{ $row['default_enabled'] ? 'Evet' : 'Hayır' }}</td>
                            <td class="py-2 pr-4">
                                <select
                                    @class([
                                        'w-28 rounded-md border border-gray-300 px-2 py-1 text-sm',
                                        'transition focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-400 hover:border-gray-400' => ! $isReadOnlyRow,
                                        'bg-gray-100 text-gray-500 cursor-not-allowed' => $isReadOnlyRow,
                                    ])
                                    wire:model.defer="rows.{{ $index }}.override_enabled"
                                    {{ $isDisabled ? 'disabled' : '' }}
                                >
                                    <option value="">Varsayılan</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </td>
                            <td class="py-2 pr-4 text-gray-700">{{ $row['effective_enabled'] ? 'Evet' : 'Hayır' }}</td>
                            <td class="py-2 pr-4 text-gray-700">{{ $row['override_exists'] ? 'Evet' : 'Hayır' }}</td>
                            <td class="py-2 pr-4">
                                <textarea
                                    @class([
                                        'min-w-[200px] rounded-md border border-gray-300 px-2 py-1 text-sm',
                                        'transition focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-400 hover:border-gray-400' => ! $isReadOnlyRow,
                                        'opacity-100',
                                        'bg-gray-100 text-gray-500 cursor-not-allowed' => $isReadOnlyRow,
                                    ])
                                    rows="2"
                                    wire:model.defer="rows.{{ $index }}.notes"
                                    @disabled($isDisabled || $isReadOnlyRow)
                                ></textarea>
                            </td>
                            <td class="py-2 pr-4">
                                @if ($isReadOnlyRow)
                                    <button type="button" disabled class="opacity-50 cursor-not-allowed">
                                        Sıfırla
                                    </button>
                                @elseif ($canEdit && $isEditable)
                                    <x-filament::button
                                        type="button"
                                        size="sm"
                                        color="gray"
                                        wire:click="resetOverride({{ $index }})"
                                        :disabled="$resetDisabled"
                                    >
                                        Sıfırla
                                    </x-filament::button>
                                @endif
                                @if (! ($canEdit && $isEditable))
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if ($this->canEdit())
                <div class="mt-6 border-t border-gray-100 pt-4 flex gap-3">
                    <x-filament::button type="submit" color="primary">
                        Kaydet
                    </x-filament::button>
                </div>
            @endif
        </form>

        <x-filament-actions::modals />
    </x-filament::section>
</x-filament-panels::page>
