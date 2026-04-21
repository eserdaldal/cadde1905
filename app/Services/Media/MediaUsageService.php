<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class MediaUsageService
{
    public function getUsageCount(int $mediaId): int
    {
        return DB::table('mediaables')
            ->where('media_id', $mediaId)
            ->count();
    }

    public function getUsages(int $mediaId): Collection
    {
        return DB::table('mediaables')
            ->where('media_id', $mediaId)
            ->orderBy('mediable_type')
            ->orderBy('mediable_id')
            ->orderBy('usage_type')
            ->get();
    }

    public function isShared(int $mediaId): bool
    {
        return $this->getUsageCount($mediaId) > 1;
    }

    public function isOrphan(int $mediaId): bool
    {
        return $this->getUsageCount($mediaId) === 0;
    }

    public function getUsageStatus(int $mediaId): string
    {
        $count = $this->getUsageCount($mediaId);

        return match (true) {
            $count === 0 => 'kullanılmıyor',
            $count === 1 => 'tek kullanım',
            default => 'paylaşımlı kullanım',
        };
    }

    public function detachFromModel(Model $model, int $mediaId): bool
    {
        $deleted = DB::table('mediaables')
            ->where('media_id', $mediaId)
            ->where('mediable_type', $model::class)
            ->where('mediable_id', $model->getKey())
            ->delete();

        return $deleted > 0;
    }

    public function deleteIfUnused(int $mediaId): bool
    {
        if (! $this->isOrphan($mediaId)) {
            return false;
        }

        /** @var Media|null $media */
        $media = Media::find($mediaId);

        if (! $media) {
            return false;
        }

        if ($media->path) {
            $disk = $media->disk ?: 'public';

            if (Storage::disk($disk)->exists($media->path)) {
                Storage::disk($disk)->delete($media->path);
                
                // [NEW] Cleanup Derived Files (Thumb, WebP)
                $dir = dirname($media->path);
                $uuid = $media->uuid;
                $derivedDir = $dir . '/derived';
                
                if (Storage::disk($disk)->exists($derivedDir)) {
                    // Delete specific derived files for this UUID
                    $files = Storage::disk($disk)->files($derivedDir);
                    foreach ($files as $file) {
                        if (str_contains(basename($file), $uuid . '__')) {
                            Storage::disk($disk)->delete($file);
                        }
                    }
                    
                    // Optionally delete derived directory if empty
                    if (empty(Storage::disk($disk)->files($derivedDir))) {
                        Storage::disk($disk)->deleteDirectory($derivedDir);
                    }
                }
            }
        }

        $media->delete();

        return true;
    }

    public function deleteMediaByIdIfUnused(int $mediaId): bool
    {
        $usageCount = $this->getUsageCount($mediaId);

        if ($usageCount > 0) {
            throw new RuntimeException('Bu medya başka içeriklerde kullanılıyor. Önce tüm ilişkiler kaldırılmalıdır.');
        }

        return $this->deleteIfUnused($mediaId);
    }

    public function cleanupOrphanMediaIds(array $mediaIds): array
    {
        $deleted = 0;
        $skipped = 0;

        foreach ($mediaIds as $mediaId) {
            $mediaId = (int) $mediaId;

            if ($mediaId <= 0) {
                continue;
            }

            if ($this->isOrphan($mediaId)) {
                $didDelete = $this->deleteIfUnused($mediaId);

                if ($didDelete) {
                    $deleted++;
                } else {
                    $skipped++;
                }

                continue;
            }

            $skipped++;
        }

        return [
            'deleted' => $deleted,
            'skipped' => $skipped,
        ];
    }

    public function cleanupAllOrphans(): array
    {
        $orphanIds = DB::table('media')
            ->leftJoin('mediaables', 'mediaables.media_id', '=', 'media.id')
            ->whereNull('mediaables.id')
            ->pluck('media.id')
            ->map(fn ($id) => (int) $id)
            ->all();

        return $this->cleanupOrphanMediaIds($orphanIds);
    }

    public function detachAndMaybeDelete(Model $model, int $mediaId): array
    {
        $detached = $this->detachFromModel($model, $mediaId);

        if (! $detached) {
            return [
                'detached' => false,
                'deleted' => false,
                'shared' => false,
                'usage_count_after_detach' => $this->getUsageCount($mediaId),
            ];
        }

        $usageCountAfterDetach = $this->getUsageCount($mediaId);
        $shared = $usageCountAfterDetach > 0;
        $deleted = false;

        if ($usageCountAfterDetach === 0) {
            $deleted = $this->deleteIfUnused($mediaId);
        }

        return [
            'detached' => true,
            'deleted' => $deleted,
            'shared' => $shared,
            'usage_count_after_detach' => $usageCountAfterDetach,
        ];
    }
}