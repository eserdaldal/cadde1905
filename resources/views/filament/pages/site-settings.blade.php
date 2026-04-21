<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">Site Modu</x-slot>
        <x-slot name="description">
            <strong>Ghost:</strong> Demo içerikler dahil tüm içerikler görünür.<br>
            <strong>Live:</strong> Sadece <code>is_demo = 0</code> işaretli gerçek içerikler görünür.
        </x-slot>

        <form wire:submit="save">
            {{ $this->form }}

            <div class="mt-6 flex gap-3">
                <x-filament::button type="submit" color="primary">
                    Kaydet
                </x-filament::button>
            </div>
        </form>

        <x-filament-actions::modals />
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">API Sync</x-slot>
        <x-slot name="description">
            Snapshot-first yapı için manuel senkron tetikleyicileri.
        </x-slot>

        <div class="space-y-6">
            <div>
                <div class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Süper Lig</div>
                <div class="flex flex-wrap gap-3">
                    @foreach ($api_sync_actions as $action)
                        <x-filament::button
                            type="button"
                            color="primary"
                            wire:click="syncApi('{{ $action['key'] }}')"
                        >
                            {{ $action['label'] }}
                        </x-filament::button>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-800 pt-6">
                <div class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">World Cup</div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Stage Seç</label>
                        <select
                            wire:model="worldcup_stage"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-800 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                        >
                            <option value="">— stage seç —</option>
                            @foreach ($worldcup_stage_options as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-3">
                        <x-filament::button type="button" color="primary" wire:click="syncWorldCupFull">
                            Full Sync
                        </x-filament::button>
                        <x-filament::button type="button" color="secondary" wire:click="syncWorldCupStage">
                            Seçili Stage Sync
                        </x-filament::button>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-panels::page>
