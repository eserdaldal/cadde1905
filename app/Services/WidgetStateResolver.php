<?php

namespace App\Services;

use App\Models\WidgetOverride;
use Illuminate\Support\Facades\Schema;

class WidgetStateResolver
{
    private const ORDER_SCALE = 1000;

    /**
     * @param array<int, array<string, mixed>> $registry
     * @return array<int, array<string, mixed>>
     */
    public function apply(array $registry): array
    {
        $overrides = $this->loadOverrides();

        if ($overrides === null) {
            return $registry;
        }

        $registryOrder = [];

        foreach ($registry as $index => $widget) {
            if (! isset($widget['key'])) {
                continue;
            }

            $registryOrder[(string) $widget['key']] = $index;
        }

        return array_map(function (array $widget) use ($overrides, $registryOrder) {
            $override = $overrides[$widget['key']] ?? null;

            $effectiveEnabled = $widget['enabled'];
            $effectivePriority = $widget['priority'];
            $originalOrder = $registryOrder[$widget['key']] ?? 0;

            if ($override) {
                if ($override->is_enabled !== null) {
                    $effectiveEnabled = (bool) $override->is_enabled;
                }

                if ($override->priority_override !== null) {
                    $effectivePriority = (int) $override->priority_override;
                }
            }

            $sortPriority = $this->buildSortPriority((int) $effectivePriority, (int) $originalOrder);

            return [
                ...$widget,
                'effective_enabled' => $effectiveEnabled,
                'effective_priority' => $effectivePriority,
                'enabled' => $effectiveEnabled,
                'priority' => $sortPriority,
            ];
        }, $registry);
    }

    /**
     * @return array<string, WidgetOverride>|null
     */
    private function loadOverrides(): ?array
    {
        try {
            if (! Schema::hasTable('widget_overrides')) {
                return null;
            }

            return WidgetOverride::query()
                ->get()
                ->keyBy('widget_key')
                ->all();
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function buildSortPriority(int $effectivePriority, int $originalOrder): int
    {
        return ($effectivePriority * self::ORDER_SCALE) + $originalOrder;
    }
}
