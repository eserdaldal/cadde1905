@php
    $record = $getRecord();
    $items = $record ? $record->galleryMedia()->orderBy('mediaables.sort_order')->get() : collect();
@endphp

<div class="news-gallery-refinement space-y-4">
    <div class="flex items-center gap-2 border-b border-gray-200/60 pb-2">
        <h4 class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Galeri</h4>
        @if($items->isNotEmpty())
            <span class="rounded-full bg-indigo-500/10 px-1.5 py-0.5 text-[10px] font-bold text-indigo-400/90 ring-1 ring-inset ring-indigo-500/20">
                {{ $items->count() }}
            </span>
        @endif
    </div>
 
    @if ($items->isEmpty())
        <div class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-200 bg-gray-100/50 py-8 text-center">
            <x-heroicon-o-squares-plus class="mb-2 h-8 w-8 text-gray-400/40" />
            <span class="text-[11px] text-gray-400 font-medium tracking-tight">Galeri henüz boş</span>
        </div>
    @else
        <div class="grid grid-cols-3 gap-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($items as $media)
                <div class="flex flex-col gap-1">
                    <div class="group relative aspect-square overflow-hidden rounded-lg border border-gray-200 bg-white shadow-none transition-all hover:border-primary-500/40">
                        <img
                            src="{{ $media->url }}"
                            alt="Galeri Görseli"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy"
                        >
                    </div>
                    
                    @if (method_exists($this, 'removeFromGallery'))
                        <div class="flex justify-start px-0.5">
                            <button
                                type="button"
                                wire:click="removeFromGallery({{ $media->id }})"
                                class="flex items-center gap-1 text-[9px] font-medium text-gray-500/60 transition-colors hover:text-red-500"
                            >
                                <x-heroicon-o-trash class="h-2.5 w-2.5 opacity-40" />
                                <span>Kaldır</span>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
