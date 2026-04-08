@php
    $record = $getRecord();
    $type = $type ?? 'cover';

    $items = collect();

    if ($record) {
        $items = match ($type) {
            'cover' => $record->coverMedia()->get(),
            'gallery' => $record->galleryMedia()->orderBy('mediaables.sort_order')->get(),
            'video' => $record->videoMedia()->orderBy('mediaables.sort_order')->get(),
            default => collect(),
        };
    }

    $titleMap = [
        'cover' => 'Mevcut Kapak',
        'gallery' => 'Mevcut Galeri',
        'video' => 'Mevcut Video',
    ];

    $emptyMap = [
        'cover' => 'Kapak görseli bulunmuyor.',
        'gallery' => 'Galeri görseli bulunmuyor.',
        'video' => 'Video bulunmuyor.',
    ];

    $title = $titleMap[$type] ?? 'Medya';
    $emptyText = $emptyMap[$type] ?? 'Medya bulunmuyor.';
@endphp

<div class="rounded-lg border border-gray-800 bg-gray-950/40 p-3">
    <div class="mb-2 flex items-center justify-between gap-3">
        <div class="min-w-0">
            <div class="text-xs font-semibold tracking-wide text-gray-200">
                {{ $title }}
            </div>
            <div class="mt-0.5 text-[11px] text-gray-500">
                @if (! $record)
                    Kayıt sonrası görünür.
                @elseif ($items->isEmpty())
                    {{ $emptyText }}
                @else
                    {{ $items->count() }} öğe
                @endif
            </div>
        </div>
    </div>

    @if (! $record)
        <div class="rounded-md border border-dashed border-gray-800 bg-black/20 px-3 py-4 text-center text-xs text-gray-500">
            Önizleme için önce kayıt oluştur.
        </div>
    @elseif ($items->isEmpty())
        <div class="rounded-md border border-dashed border-gray-800 bg-black/20 px-3 py-4 text-center text-xs text-gray-500">
            {{ $emptyText }}
        </div>
    @elseif ($type === 'cover')
        @php
            $media = $items->first();
            $mediaName = $media?->original_name ?: basename((string) $media?->path);
        @endphp

        <div class="overflow-hidden rounded-md border border-gray-800 bg-gray-900/60">
            <div class="grid md:grid-cols-[220px_1fr]">
                <div class="aspect-[4/3] bg-black/30">
                    <img
                        src="{{ $media->url }}"
                        alt="{{ $mediaName ?: 'Kapak görseli' }}"
                        class="h-full w-full object-cover"
                        loading="lazy"
                    >
                </div>

                <div class="flex flex-col justify-center gap-2 px-3 py-3">
                    <div class="text-sm font-medium text-gray-100 break-words">
                        {{ $mediaName ?: 'Kapak görseli' }}
                    </div>

                    <div class="text-[11px] text-gray-500">
                        ID: {{ $media->id }}
                    </div>
                </div>
            </div>
        </div>
    @elseif ($type === 'video')
        @php
            $media = $items->first();
            $provider = strtoupper((string) ($media?->embed_provider ?: 'video'));
            $url = $media?->embed_url ?: '#';
            $label = $media?->title_override ?: $media?->original_name ?: $url;
        @endphp

        <div class="rounded-md border border-gray-800 bg-gray-900/60 px-3 py-3">
            <div class="mb-2 text-[11px] font-semibold tracking-wide text-gray-400">
                {{ $provider }}
            </div>

            <div class="mb-2 text-sm font-medium text-gray-100 break-words">
                {{ $label }}
            </div>

            <a
                href="{{ $url }}"
                target="_blank"
                rel="noopener noreferrer"
                class="block break-all text-xs text-blue-400 underline underline-offset-2"
            >
                {{ $url }}
            </a>

            <div class="mt-2 text-[11px] text-gray-500">
                ID: {{ $media->id }}
            </div>
        </div>
    @elseif ($type === 'gallery')
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($items as $media)
                @php
                    $mediaName = $media->original_name ?: basename((string) $media->path);
                @endphp

                <div class="overflow-hidden rounded-md border border-gray-800 bg-gray-900/60">
                    <div class="aspect-[4/3] bg-black/30">
                        <img
                            src="{{ $media->url }}"
                            alt="{{ $mediaName ?: 'Galeri görseli' }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >
                    </div>

                    <div class="px-2 py-2">
                        <div class="line-clamp-2 text-[11px] font-medium text-gray-300">
                            {{ $mediaName ?: 'İsimsiz medya' }}
                        </div>

                        <div class="mt-1 text-[10px] text-gray-500">
                            ID: {{ $media->id }}
                        </div>

                        @if (method_exists($this, 'removeGalleryItem'))
                            <div class="mt-2">
                                <button
                                    type="button"
                                    wire:click="removeGalleryItem({{ $media->id }})"
                                    class="inline-flex items-center rounded-md border border-red-900/60 bg-red-950/30 px-2 py-1 text-[10px] font-medium text-red-300 hover:bg-red-950/50"
                                >
                                    Galeriden kaldır
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
