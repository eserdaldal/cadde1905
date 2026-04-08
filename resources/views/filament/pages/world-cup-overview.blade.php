<x-filament-panels::page>
    <div class="grid gap-4 md:grid-cols-6 mb-6">
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <div class="text-xs font-medium text-gray-500 uppercase">Takımlar</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">{{ $overview['teams'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <div class="text-xs font-medium text-gray-500 uppercase">Gruplar</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">{{ $overview['groups'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <div class="text-xs font-medium text-gray-500 uppercase">Maçlar</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">{{ $overview['matches'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <div class="text-xs font-medium text-gray-500 uppercase">Stadyumlar</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">{{ $overview['stadiums'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <div class="text-xs font-medium text-gray-500 uppercase">Oyuncular</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">{{ $overview['players'] ?? 0 }}</div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <div class="text-xs font-medium text-gray-500 uppercase">Puan Durumu</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">{{ $overview['standings'] ?? 0 }}</div>
        </div>
    </div>

    <x-filament::section>
        <x-slot name="heading">Veri Sağlığı ve API Durumu</x-slot>
        <x-slot name="description">Tournament 2026 veri setlerinin güncellik ve doluluk analizi.</x-slot>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="py-3 px-4">Veri Türü</th>
                        <th class="py-3 px-4">Durum</th>
                        <th class="py-3 px-4">Son Kontrol</th>
                        <th class="py-3 px-4">Son Güncelleme</th>
                        <th class="py-3 px-4">Açıklama</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($apiHealth as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4 font-semibold text-gray-900">
                                {{ $item['label'] }}
                                <span class="block text-[10px] text-gray-400 font-mono mt-0.5 uppercase tracking-tighter">
                                    {{ $item['record_count'] }} Kayıt
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @php
                                    $colorMap = [
                                        'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'warning' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'danger' => 'bg-red-50 text-red-700 border-red-200',
                                        'gray' => 'bg-gray-50 text-gray-600 border-gray-200',
                                    ];
                                    $colorClass = $colorMap[$item['status_color']] ?? $colorMap['gray'];
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-bold border {{ $colorClass }}">
                                    {{ $item['status_label'] }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-gray-600 font-medium">
                                {{ $item['last_checked_at'] }}
                            </td>
                            <td class="py-4 px-4 text-gray-600 font-medium">
                                {{ $item['last_success_at'] }}
                            </td>
                            <td class="py-4 px-4 text-gray-500 text-xs">
                                {{ $item['note'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>

    <div class="mt-6 flex flex-col gap-2 p-4 rounded-lg bg-gray-50 border border-gray-200 text-xs text-gray-500">
        <p><strong>Bilgi:</strong> "Henüz Açıklanmadı" durumundaki veriler için API Negative Cache (12-24 saat) uygulanır.</p>
        <p><strong>Bilgi:</strong> Dinamik veriler (Fikstür, Puan Durumu) her 15-30 dakikada bir kontrol edilir.</p>
    </div>
</x-filament-panels::page>
