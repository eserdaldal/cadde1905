<?php

namespace App\Services\Timeline;

use App\Models\TimelineEntry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class TimelinePageService
{
    public function getEntries(?string $type = null, int $perPage = 20): LengthAwarePaginator
    {
        $query = TimelineEntry::query()
            ->with('source')
            ->visible()
            ->orderedForPublic();

        if ($type && array_key_exists($type, TimelineEntry::typeOptions())) {
            $query->where('type', $type);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function getFilterOptions(): array
    {
        return TimelineEntry::typeOptions();
    }
}