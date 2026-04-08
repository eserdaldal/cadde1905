<?php

namespace App\Services\Campaigns;

use App\Models\Campaign;
use Illuminate\Support\Facades\Schema;

class CampaignResolver
{
    /**
     * Higher numeric priority wins.
     */
    private const ACTIVE_STATUSES = ['active', 'scheduled'];

    /**
     * @return array<string, mixed>|null
     */
    public function resolve(): ?array
    {
        try {
            if (! Schema::hasTable('campaigns')) {
                return null;
            }
        } catch (\Throwable) {
            return null;
        }

        try {
            $now = now();

            $campaign = Campaign::query()
                ->where('is_enabled', true)
                ->whereIn('status', self::ACTIVE_STATUSES)
                ->where(function ($query) use ($now): void {
                    $query->whereNull('starts_at')
                        ->orWhere('starts_at', '<=', $now);
                })
                ->where(function ($query) use ($now): void {
                    $query->whereNull('ends_at')
                        ->orWhere('ends_at', '>=', $now);
                })
                ->orderByDesc('priority')
                ->orderByDesc('updated_at')
                ->orderBy('id')
                ->first();

            if (! $campaign) {
                return null;
            }

            return [
                'key' => $campaign->key,
                'title' => $campaign->title,
                'subtitle' => $campaign->subtitle,
                'description' => $campaign->description,
                'cta_label' => $campaign->cta_label,
                'cta_route_name' => $campaign->cta_route_name,
                'cta_route_params' => $campaign->cta_route_params ?? [],
                'priority' => $campaign->priority,
                'status' => $campaign->status,
            ];
        } catch (\Throwable) {
            return null;
        }
    }
}
