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
</x-filament-panels::page>
