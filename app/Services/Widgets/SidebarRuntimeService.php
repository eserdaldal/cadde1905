<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Services\WidgetStateResolver;

final class SidebarRuntimeService
{
    /**
     * Widget registry
     */
    private function registry(): array
    {
        return [
            [
                'key' => 'next-match',
                'component' => 'widgets.next-match',
                'priority' => 10,
                'lifecycle' => 'always_on',
                'enabled' => true,
            ],
            [
                'key' => 'league-table',
                'component' => 'widgets.league-table',
                'priority' => 20,
                'lifecycle' => 'always_on',
                'enabled' => true,
            ],
            [
                'key' => 'popular-content',
                'component' => 'widgets.popular-content',
                'priority' => 30,
                'lifecycle' => 'always_on',
                'enabled' => true,
            ],
            [
                'key' => 'on-this-day',
                'component' => 'widgets.on-this-day',
                'priority' => 40,
                'lifecycle' => 'data_aware',
                'enabled' => true,
            ],
            [
                'key' => 'dynamic-campaign',
                'component' => 'widgets.dynamic-campaign',
                'priority' => 50,
                'lifecycle' => 'seasonal',
                'enabled' => true,
            ],
            [
                'key' => 'disabled-aslanlar',
                'component' => 'widgets.disabled-aslanlar',
                'priority' => 60,
                'lifecycle' => 'always_on',
                'enabled' => true,
            ],
            [
                'key' => 'join-community',
                'component' => 'widgets.join-community',
                'priority' => 999,
                'lifecycle' => 'dormant',
                'enabled' => true,
            ],
        ];
    }

    /**
     * Registry with DB-backed override merge
     */
    private function registryWithOverrides(): array
    {
        return app(WidgetStateResolver::class)->apply($this->registry());
    }

    /**
     * Resolve single widget visibility
     */
    private function resolve(array $widget): array
    {
        if (!$widget['enabled']) {
            return [...$widget, 'should_render' => false, 'reason' => 'disabled'];
        }

        switch ($widget['key']) {

            case 'on-this-day':
                $data = app(\App\Services\Widgets\OnThisDayWidgetService::class)->getData();
                return [
                    ...$widget,
                    'should_render' => !empty($data['item']),
                    'reason' => empty($data['item']) ? 'empty_data' : 'has_data',
                ];

            case 'dynamic-campaign':
                $campaign = app(\App\Services\Widgets\DynamicCampaignWidgetService::class)->build();
                return [
                    ...$widget,
                    'should_render' => (($campaign['status'] ?? 'inactive') === 'ok'),
                    'reason' => (($campaign['status'] ?? 'inactive') === 'ok') ? 'active_campaign' : 'inactive_campaign',
                ];

            case 'join-community':
                return [...$widget, 'should_render' => false, 'reason' => 'dormant'];

            default:
                return [...$widget, 'should_render' => true, 'reason' => 'always_on'];
        }
    }

    /**
     * Visible widgets only
     */
    public function getVisibleWidgets(): array
    {
        $resolved = array_map(fn($w) => $this->resolve($w), $this->registryWithOverrides());

        $visible = array_filter($resolved, fn($w) => $w['should_render'] === true);

        usort($visible, fn($a, $b) => $a['priority'] <=> $b['priority']);

        return array_values($visible);
    }

    /**
     * Debug snapshot (optional use)
     */
    public function getDebugSnapshot(): array
    {
        return array_map(fn($w) => $this->resolve($w), $this->registryWithOverrides());
    }
}
