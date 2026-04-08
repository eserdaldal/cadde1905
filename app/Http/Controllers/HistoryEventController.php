<?php

namespace App\Http\Controllers;

use App\Models\HistoryEvent;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryEventController extends Controller
{
    public function indexByType(Request $request, string $type): View
    {
        [$pageTitle, $pageDescription] = $this->typeMeta($type);

        $items = HistoryEvent::query()
            ->where('is_published', true)
            ->where('type', $type)
            ->orderByDesc('event_date')
            ->orderByDesc('year')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.miras.history-events.index', [
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'type' => $type,
            'items' => $items,
        ]);
    }

    public function show(Request $request, string $slug, string $expectedType): View
    {
        $historyEvent = HistoryEvent::query()
            ->with([
                'media',
                'coverMedia',
                'galleryMedia',
                'videoMedia',
            ])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        if ($historyEvent->type !== $expectedType) {
            abort(404);
        }

        return view('pages.miras.history-events.show', [
            'historyEvent' => $historyEvent,
            'pageTitle' => $historyEvent->title,
            'pageDescription' => $historyEvent->excerpt ?: $historyEvent->description ?: null,
            'typeLabel' => $this->typeLabel($historyEvent->type),
        ]);
    }

    protected function typeLabel(string $type): string
    {
        return match ($type) {
            'moment' => 'An',
            'era' => 'Dönem',
            'squad' => 'Kadro',
            'achievement' => 'Başarı',
            'milestone' => 'Dönüm Noktası',
            default => ucfirst($type),
        };
    }

    protected function typeMeta(string $type): array
    {
        return match ($type) {
            'moment' => [
                'Anlar',
                'Galatasaray tarihindeki seçilmiş önemli anlar.',
            ],
            'era' => [
                'Dönemler',
                'Galatasaray tarihindeki belirleyici dönem anlatıları.',
            ],
            'squad' => [
                'Kadrolar',
                'Kulüp tarihindeki öne çıkan efsane kadrolar.',
            ],
            'achievement' => [
                'Başarılar',
                'Galatasaray tarihinin büyük başarı hikâyeleri.',
            ],
            'milestone' => [
                'Dönüm Noktaları',
                'Kulüp tarihindeki kırılma ve dönüm noktaları.',
            ],
            default => abort(404),
        };
    }
}