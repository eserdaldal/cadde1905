<?php

declare(strict_types=1);

namespace App\View\Components\Widgets;

use App\Services\Widgets\PopularContentWidgetService;
use Illuminate\View\Component;
use Illuminate\View\View;

final class PopularContent extends Component
{
    /**
     * @var array{
     *     title:string,
     *     status:string,
     *     props:array<string,mixed>,
     *     data:array<string,mixed>,
     *     meta:array<string,mixed>
     * }
     */
    public array $widget;

    public function __construct(PopularContentWidgetService $service)
    {
        $this->widget = $service->build();
    }

    public function render(): View
    {
        return view('components.widgets.popular-content', [
            'title' => $this->widget['title'],
            'status' => $this->widget['status'],
            'props' => $this->widget['props'],
            'data' => $this->widget['data'],
            'meta' => $this->widget['meta'],
            'items' => $this->widget['data']['items'] ?? [],
        ]);
    }
}

