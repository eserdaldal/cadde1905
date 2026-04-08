<?php

namespace App\Models\Concerns;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasCoverMedia
{
    public function media(): MorphToMany
    {
        return $this->morphToMany(
            Media::class,
            'mediable',
            'mediaables',
            'mediable_id',
            'media_id'
        )
            ->withPivot([
                'usage_type',
                'sort_order',
                'is_primary',
                'title_override',
                'caption',
                'credit',
                'notes',
            ])
            ->withTimestamps();
    }

    public function coverMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'cover');
    }

    public function primaryCoverMedia()
    {
        return $this->coverMedia()
            ->orderByDesc('mediaables.is_primary')
            ->orderBy('mediaables.sort_order')
            ->orderByDesc('mediaables.id')
            ->first();
    }

    public function coverImageUrl(): ?string
    {
        $primaryMedia = $this->primaryCoverMedia();

        if ($primaryMedia && ! empty($primaryMedia->path)) {
            $disk = $primaryMedia->disk ?: 'public';

            try {
                return Storage::disk($disk)->url($primaryMedia->path);
            } catch (\Throwable $e) {
                // fallback below
            }
        }

        $legacyColumn = $this->legacyCoverColumn();

        if (! $legacyColumn || empty($this->{$legacyColumn})) {
            return null;
        }

        $legacyValue = $this->{$legacyColumn};

        if (Str::startsWith($legacyValue, ['http://', 'https://'])) {
            return $legacyValue;
        }

        return asset('storage/' . ltrim($legacyValue, '/'));
    }

    public function hasCoverImage(): bool
    {
        return ! empty($this->coverImageUrl());
    }

    public function replaceCoverFromUpload(mixed $fileOrPath): void
    {
        if (blank($fileOrPath)) {
            return;
        }

        // Handle arrays (Filament FileUpload often returns [0 => UploadedFile])
        if (is_array($fileOrPath)) {
            $fileOrPath = reset($fileOrPath);
        }

        if (blank($fileOrPath)) {
            return;
        }

        if ($fileOrPath instanceof \Illuminate\Http\UploadedFile) {
            /** @var \App\Services\Media\MediaUploadService $service */
            $service = app(\App\Services\Media\MediaUploadService::class);

            $media = $service->replacePrimaryForModel(
                $this,
                $fileOrPath,
                'cover',
                [
                    'media_kind' => 'image',
                    'storage_type' => 'file',
                ],
                [
                    'title_override' => $this->coverMediaAltText(),
                ]
            );

            // Sync legacy column if exists
            $legacyColumn = $this->legacyCoverColumn();
            if ($legacyColumn && ! empty($media->path)) {
                $this->forceFill([
                    $legacyColumn => $media->path,
                ])->saveQuietly();
            }

            return;
        }

        // --- BACKWARD COMPATIBILITY FOR STRING PATHS ---
        $uploadedPath = (string) $fileOrPath;

        $disk = 'public';
        $storage = Storage::disk($disk);

        $absolutePath = null;
        $mimeType = null;
        $size = null;
        $width = null;
        $height = null;

        try {
            $absolutePath = $storage->path($uploadedPath);
        } catch (\Throwable $e) {
            $absolutePath = null;
        }

        try {
            $mimeType = $storage->mimeType($uploadedPath);
        } catch (\Throwable $e) {
            $mimeType = null;
        }

        try {
            $size = $storage->size($uploadedPath);
        } catch (\Throwable $e) {
            $size = null;
        }

        if ($absolutePath && is_file($absolutePath)) {
            try {
                $imageInfo = @getimagesize($absolutePath);

                if (is_array($imageInfo)) {
                    $width = $imageInfo[0] ?? null;
                    $height = $imageInfo[1] ?? null;
                }
            } catch (\Throwable $e) {
                $width = null;
                $height = null;
            }
        }

        $legacyColumn = $this->legacyCoverColumn();

        if ($legacyColumn) {
            // ONLY save to legacy column if it's NOT a temporary path.
            // Temporary paths (livewire-tmp/) must be handled by MediaUploadService.
            if (! Str::startsWith($uploadedPath, 'livewire-tmp/')) {
                $this->forceFill([
                    $legacyColumn => $uploadedPath,
                ])->saveQuietly();
            }
        }

        $media = new Media();
        $media->uuid = (string) Str::uuid();
        $media->media_kind = 'image';
        $media->storage_type = 'file';
        $media->disk = $disk;
        $media->path = $uploadedPath;
        $media->original_name = basename($uploadedPath);
        $media->extension = pathinfo($uploadedPath, PATHINFO_EXTENSION) ?: null;
        $media->mime_type = $mimeType;
        $media->size = $size;
        $media->width = $width;
        $media->height = $height;
        $media->alt_text = $this->coverMediaAltText();
        $media->is_active = true;
        $media->save();

        $this->replaceCoverFromExistingMedia($media->id);
    }

    public function removeCover(): void
    {
        $mediaIds = $this->media()
            ->wherePivot('usage_type', 'cover')
            ->pluck('media.id')
            ->all();

        if (empty($mediaIds)) {
            return;
        }

        $this->media()->detach($mediaIds);

        // Sync legacy column
        $legacyColumn = $this->legacyCoverColumn();
        if ($legacyColumn) {
            $this->forceFill([
                $legacyColumn => null,
            ])->saveQuietly();
        }

        // Cleanup orphans if they are not used elsewhere
        /** @var \App\Services\Media\MediaUsageService $usageService */
        $usageService = app(\App\Services\Media\MediaUsageService::class);
        foreach ($mediaIds as $id) {
            $usageService->deleteIfUnused((int) $id);
        }
    }

    public function replaceCoverFromExistingMedia(int|string|null $mediaId): void
    {
        if (blank($mediaId)) {
            return;
        }

        $media = Media::query()
            ->whereKey($mediaId)
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->first();

        if (! $media) {
            return;
        }

        $legacyColumn = $this->legacyCoverColumn();

        if ($legacyColumn && ! empty($media->path)) {
            $this->forceFill([
                $legacyColumn => $media->path,
            ])->saveQuietly();
        }

        $this->media()
            ->newPivotStatement()
            ->where('mediable_type', static::class)
            ->where('mediable_id', $this->id)
            ->where('usage_type', 'cover')
            ->delete();

        $this->media()->attach($media->id, [
            'usage_type' => 'cover',
            'sort_order' => 0,
            'is_primary' => true,
        ]);
    }

    protected function legacyCoverColumn(): ?string
    {
        return null;
    }

    protected function coverMediaAltText(): ?string
    {
        if (isset($this->name) && ! empty($this->name)) {
            return $this->name;
        }

        if (isset($this->title) && ! empty($this->title)) {
            return $this->title;
        }

        return null;
    }
}