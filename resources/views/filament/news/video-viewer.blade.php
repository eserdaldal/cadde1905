@php
    $record = $getRecord();
    $media = $record ? $record->videoMedia()->first() : null;
@endphp

<div class="news-video-refinement space-y-3">
    <div class="border-b border-gray-200/60 pb-2">
        <h4 class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Video İçeriği</h4>
    </div>

    @if ($record && $media)
        @php
            $provider = strtoupper((string) ($media->embed_provider ?: 'video'));
            $url = $media->embed_url ?: '#';
            $label = $media->title_override ?: $media->original_name ?: 'Video İzle';
        @endphp

        <div class="group relative flex items-start gap-0 py-2 transition-all">
            <div class="min-w-0 flex-1">
                <div class="truncate text-[13px] font-medium text-gray-600">
                    {{ $label }}
                </div>
                <div class="mt-0.5 flex items-center gap-2">
                    <a href="{{ $url }}" target="_blank" class="inline-flex items-center gap-1 text-[13px] font-bold text-primary-500 decoration-primary-500/30 underline-offset-4 hover:underline hover:text-primary-400 transition-all">
                        Videoyu Dış Bağlantıda Aç <x-heroicon-m-arrow-top-right-on-square class="h-3.5 w-3.5 opacity-80" />
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if (method_exists($this, 'removeVideo'))
                    <button
                        type="button"
                        wire:click="removeVideo({{ $media->id }})"
                        class="rounded-lg p-1.5 text-gray-500 hover:bg-red-500/10 hover:text-red-500 transition-all"
                        title="Kaldır"
                    >
                        <x-heroicon-o-trash class="h-4 w-4" />
                    </button>
                @endif
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-200 py-6 text-center">
            <x-heroicon-o-video-camera class="mb-2 h-8 w-8 text-gray-300" />
            <span class="text-[11px] text-gray-400 font-medium">Video eklenmedi</span>
        </div>
    @endif
</div>
