<?php

namespace App\Http\Controllers;

use App\Models\HistoryEvent;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryEventPreviewController extends Controller
{
    public function show(Request $request, HistoryEvent $historyEvent): View
    {
        abort_unless($request->hasValidSignature(), 403);

        $historyEvent->load([
            'media',
            'coverMedia',
            'galleryMedia',
            'videoMedia',
        ]);

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
}
