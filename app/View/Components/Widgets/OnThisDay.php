<?php

declare(strict_types=1);

namespace App\View\Components\Widgets;

use App\Services\Widgets\OnThisDayWidgetService;
use Illuminate\View\Component;
use Illuminate\View\View;

final class OnThisDay extends Component
{
    /**
     * @var ?array{title:string,slug:string,url:string,year:?int,excerpt:?string}
     */
    public ?array $item = null;

    /**
     * @var array<int, array{title:string,slug:string,url:string,year:?int,excerpt:?string}>
     */
    public array $items = [];

    /**
     * Widget Contract (SSOT)
     */
    public string $title = 'Tarihte Bugün';
    public string $status = 'ok';
    public array $props = [];
    public array $data = [];
    public array $meta = [];

    public function __construct(private readonly OnThisDayWidgetService $service)
    {
        $payload = $this->service->getData($this->props);

        $this->title = (string) ($payload['title'] ?? $this->title);
        $this->items = $payload['items'] ?? [];
        $this->item = $payload['item'] ?? null;
        $this->status = $this->item ? 'ok' : 'empty';

        $this->data = [
            'item' => $this->item,
            'items' => $this->items,
        ];

        $this->meta = $payload['meta'] ?? [];
    }

    public function render(): View
    {
        // Backward-compatible: Blade dosyası eski isimlerle bekliyor olabilir.
        return view('components.widgets.on-this-day', [
            'title' => $this->title,
            'status' => $this->status,
            'props' => $this->props,
            'data' => $this->data,
            'meta' => $this->meta,
            'item' => $this->item,

            // Olası eski kullanım isimleri:
            'items' => $this->items,
            'events' => $this->items,
        ]);
    }
}
