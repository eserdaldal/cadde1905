@php
    $record = $getRecord();
    $title = $title ?? 'Mevcut Kapak';
    $emptyText = $emptyText ?? 'Kapak görseli bulunmuyor.';
    $imageUrl = null;

    if ($record && method_exists($record, 'coverImageUrl')) {
        $imageUrl = $record->coverImageUrl();
    }
@endphp

<div style="border: 1px solid #27272a; border-radius: 16px; padding: 16px; background: rgba(24, 24, 27, 0.65);">
    <div style="font-size: 13px; font-weight: 600; color: #d4d4d8; margin-bottom: 12px;">
        {{ $title }}
    </div>

    @if ($imageUrl)
        <div style="overflow: hidden; border-radius: 14px; border: 1px solid #3f3f46; background: #09090b;">
            <img
                src="{{ $imageUrl }}"
                alt="Current cover preview"
                style="display: block; width: 100%; max-height: 280px; object-fit: cover;"
            >
        </div>

        <div style="margin-top: 10px; font-size: 12px; color: #a1a1aa;">
            Aktif kapak görseli yukarıda gösteriliyor. Yeni yükleme yaparsanız bu görsel güncellenir.
        </div>
    @else
        <div style="border: 1px dashed #3f3f46; border-radius: 14px; padding: 20px; text-align: center; color: #a1a1aa; background: rgba(39, 39, 42, 0.35);">
            {{ $emptyText }}
        </div>
    @endif
</div>