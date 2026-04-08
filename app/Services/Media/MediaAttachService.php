<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class MediaAttachService
{
    public function attachExistingToModel(
        Model $model,
        int $mediaId,
        string $usageType,
        array $pivotData = []
    ): bool {
        /** @var Media|null $media */
        $media = Media::query()->find($mediaId);

        if (! $media) {
            throw new InvalidArgumentException("Media not found: {$mediaId}");
        }

        $this->assertMediaCompatible($media, $usageType);

        $alreadyAttachedWithSameUsage = DB::table('mediaables')
            ->where('media_id', $media->id)
            ->where('mediable_type', $model::class)
            ->where('mediable_id', $model->getKey())
            ->where('usage_type', $usageType)
            ->exists();

        if ($alreadyAttachedWithSameUsage) {
            return false;
        }

        if (in_array($usageType, ['cover', 'video'], true)) {
            $existingIdsForUsage = DB::table('mediaables')
                ->where('mediable_type', $model::class)
                ->where('mediable_id', $model->getKey())
                ->where('usage_type', $usageType)
                ->pluck('media_id')
                ->all();

            if (! empty($existingIdsForUsage)) {
                $model->media()->detach($existingIdsForUsage);
            }
        }

        $sortOrder = $pivotData['sort_order'] ?? $this->resolveSortOrder($model, $usageType);

        $finalPivot = [
            'usage_type' => $usageType,
            'sort_order' => $sortOrder,
            'is_primary' => in_array($usageType, ['cover', 'video'], true),
            'title_override' => $pivotData['title_override'] ?? null,
        ];

        $existingPivotRow = DB::table('mediaables')
            ->where('media_id', $media->id)
            ->where('mediable_type', $model::class)
            ->where('mediable_id', $model->getKey())
            ->first();

        if ($existingPivotRow) {
            DB::table('mediaables')
                ->where('id', $existingPivotRow->id)
                ->update([
                    'usage_type' => $finalPivot['usage_type'],
                    'sort_order' => $finalPivot['sort_order'],
                    'is_primary' => $finalPivot['is_primary'],
                    'title_override' => $finalPivot['title_override'],
                    'updated_at' => now(),
                ]);

            return true;
        }

        $model->media()->attach($media->id, $finalPivot);

        return true;
    }

    public function attachExistingManyToModel(
        Model $model,
        array $mediaIds,
        string $usageType,
        array $pivotData = []
    ): int {
        $attached = 0;

        foreach ($mediaIds as $mediaId) {
            $mediaId = (int) $mediaId;

            if ($mediaId <= 0) {
                continue;
            }

            $didAttach = $this->attachExistingToModel($model, $mediaId, $usageType, $pivotData);

            if ($didAttach) {
                $attached++;
            }
        }

        return $attached;
    }

    protected function resolveSortOrder(Model $model, string $usageType): int
    {
        if ($usageType === 'gallery') {
            return (int) (
                DB::table('mediaables')
                    ->where('mediable_type', $model::class)
                    ->where('mediable_id', $model->getKey())
                    ->where('usage_type', 'gallery')
                    ->max('sort_order') ?? -1
            ) + 1;
        }

        return 0;
    }

    protected function assertMediaCompatible(Media $media, string $usageType): void
    {
        $compatible = match ($usageType) {
            'cover', 'gallery' => $media->media_kind === 'image',
            'video' => $media->media_kind === 'embed',
            default => false,
        };

        if (! $compatible) {
            throw new InvalidArgumentException(
                "Media {$media->id} is not compatible with usage type {$usageType}"
            );
        }
    }
}