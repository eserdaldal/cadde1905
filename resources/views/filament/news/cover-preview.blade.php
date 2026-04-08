@php
    $record = $getRecord();
    $media = $record?->coverMedia()->first();
    $mediaName = $media?->original_name ?: basename((string) $media?->path);
@endphp

<div class="news-cover-refinement">
    @if ($record && $media)
        <div class="group relative overflow-hidden rounded-xl bg-transparent transition-all p-1">
            <div class="aspect-video overflow-hidden rounded-xl bg-gray-100 shadow-sm border border-gray-200 transition-shadow group-hover:shadow-md">
                <img
                    src="{{ $media->url }}"
                    alt="Kapak"
                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy"
                >
            </div>
            
            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity group-hover:opacity-100 bg-black/10 backdrop-blur-[0.5px]">
                <span class="rounded-full bg-white/95 px-4 py-1.5 text-[10px] font-bold text-gray-800 shadow-xl ring-1 ring-black/5">
                    Aktif Kapak
                </span>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-200 bg-gray-50/30 py-6 text-center">
            <x-heroicon-o-photo class="mb-2 h-8 w-8 text-gray-300" />
            <span class="text-[11px] font-medium text-gray-400">Kapak görseli eklenmedi</span>
        </div>
    @endif
</div>
