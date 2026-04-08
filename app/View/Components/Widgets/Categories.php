<?php

declare(strict_types=1);

namespace App\View\Components\Widgets;

use App\Services\Widgets\CategoriesWidgetService;
use Illuminate\View\Component;
use Illuminate\View\View;

final class Categories extends Component
{
    /**
     * Render-only blade için düz veri.
     *
     * @var array<int, array{name:string, slug:string}>
     */
    public array $items = [];

    /**
     * Widget Contract (SSOT)
     */
    public string $title = 'Kategoriler';
    public string $status = 'live';
    public array $props = [];
    public array $data = [];
    public array $meta = [];

    public function __construct(private readonly CategoriesWidgetService $service)
    {
        // props şimdilik boş; ileride widget parametreleri buradan taşınacak.
        $payload = $this->service->getData($this->props);

        $this->items = $payload['items'] ?? [];

        // Contract alanları:
        $this->data = [
            'items' => $this->items,
        ];
        $this->meta = $payload['meta'] ?? [];
    }

    public function render(): View
    {
        // Backward-compatible: Blade dosyası eski isimlerle bekliyor olabilir.
        return view('components.widgets.categories', [
            'title' => $this->title,
            'status' => $this->status,
            'props' => $this->props,
            'data' => $this->data,
            'meta' => $this->meta,

            // Olası eski kullanım isimleri:
            'items' => $this->items,
            'categories' => $this->items,
        ]);
    }
}