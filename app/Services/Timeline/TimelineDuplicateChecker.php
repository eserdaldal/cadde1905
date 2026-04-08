<?php

namespace App\Services\Timeline;

use App\Models\TimelineEntry;

class TimelineDuplicateChecker
{
    public function existsReferencedDuplicate(
        string $sourceType,
        int $sourceId,
        string $timelineDate,
        ?int $ignoreId = null
    ): bool {

        // 🔥 SADECE STRICT kaynaklar duplicate kontrolüne girer
        if (! TimelineRuleSet::isStrict($sourceType)) {
            return false;
        }

        $query = TimelineEntry::query()
            ->where('source_type', $sourceType)
            ->where('source_id', $sourceId)
            ->where('timeline_date', $timelineDate);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}