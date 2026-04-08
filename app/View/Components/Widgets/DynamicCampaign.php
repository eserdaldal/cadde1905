<?php

declare(strict_types=1);

namespace App\View\Components\Widgets;

use App\Services\Widgets\DynamicCampaignWidgetService;
use Illuminate\View\Component;
use Illuminate\View\View;

final class DynamicCampaign extends Component
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

    public function __construct(DynamicCampaignWidgetService $service)
    {
        $this->widget = $service->build();
    }

    public function render(): View
    {
        return view('components.widgets.dynamic-campaign', [
            'title' => $this->widget['title'],
            'status' => $this->widget['status'],
            'props' => $this->widget['props'],
            'data' => $this->widget['data'],
            'meta' => $this->widget['meta'],
        ]);
    }
}
