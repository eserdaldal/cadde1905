@php
    /** @var \App\Models\Media $record */
    $record = $getRecord();
@endphp

@if (! $record)
    <div style="font-size:12px;opacity:.7;">Kayıt bulunamadı.</div>
@elseif ($record->media_kind === 'embed')
    <div style="display:flex;flex-direction:column;gap:10px;padding:12px;border:1px solid #2f2f2f;border-radius:8px;background:#111827;">
        <div style="font-size:12px;opacity:.85;">
            <strong>Provider:</strong> {{ $record->embed_provider ?: 'embed' }}
        </div>

        @if ($record->embed_url)
            <div style="font-size:12px;word-break:break-all;">
                <a
                    href="{{ $record->embed_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    style="color:#93c5fd;text-decoration:underline;"
                >
                    {{ $record->embed_url }}
                </a>
            </div>
        @else
            <div style="font-size:12px;opacity:.7;">Embed URL yok.</div>
        @endif
    </div>
@elseif ($record->path && $record->disk)
    <div style="display:flex;flex-direction:column;gap:10px;">
        @php
            $previewUrl = null;
            try {
                $previewUrl = \Illuminate\Support\Facades\Storage::disk($record->disk)->url($record->path);
            } catch (\Exception $e) {
                // Silently fail or log
            }
        @endphp

        @if ($previewUrl)
            <img
                src="{{ $previewUrl }}"
                alt="{{ $record->original_name ?: 'media-preview' }}"
                style="max-width:320px;max-height:220px;object-fit:cover;border-radius:8px;border:1px solid #2f2f2f;"
            >
        @else
            <div style="font-size:12px;color:#ef4444;">Önizleme yüklenemedi (Disk: {{ $record->disk }}).</div>
        @endif

        <div style="font-size:12px;opacity:.8;">
            {{ $record->original_name ?: basename($record->path) }}
        </div>
    </div>
@else
    <div style="font-size:12px;opacity:.7;">Preview yok.</div>
@endif