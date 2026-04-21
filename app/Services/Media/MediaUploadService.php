<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class MediaUploadService
{
    public function __construct(
        protected MediaPathService $pathService
    ) {
    }

    public function uploadForModel(
        Model $owner,
        UploadedFile $file,
        array $mediaData = [],
        array $pivotData = []
    ): Media {
        $checksum = \App\Support\Media\ChecksumGenerator::generateForFile($file);

        DB::beginTransaction();

        try {
            // Check for duplicate file by checksum
            $existingMedia = Media::where('checksum', $checksum)->first();

            if ($existingMedia) {
                $usageType = $pivotData['usage_type'] ?? 'gallery';

                // Check pivot duplication so we don't attach the exact same media usage twice
                $alreadyAttached = $owner->media()
                    ->where('media.id', $existingMedia->id)
                    ->wherePivot('usage_type', $usageType)
                    ->exists();

                if (! $alreadyAttached) {
                    $owner->media()->attach($existingMedia->id, [
                        'usage_type' => $usageType,
                        'sort_order' => $pivotData['sort_order'] ?? 0,
                        'is_primary' => $pivotData['is_primary'] ?? false,
                        'title_override' => $pivotData['title_override'] ?? null,
                        'caption' => $pivotData['caption'] ?? null,
                        'credit' => $pivotData['credit'] ?? null,
                        'notes' => $pivotData['notes'] ?? null,
                    ]);
                }

                DB::commit();

                return $existingMedia;
            }

            // Normal Flow (Not exists)
            $uuid = (string) Str::uuid();
            $extension = mb_strtolower($file->extension() ?: 'bin');
            $mimeType = $file->getClientMimeType();
            $mediaKind = $mediaData['media_kind'] ?? 'image';

            $originalTempPath = $file->getRealPath();
            $processedPath = null;
            $width = null;
            $height = null;
            $finalSize = $file->getSize();

            // Image Processing Logic
            $isRasterImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);
            
            if ($mediaKind === 'image' && $isRasterImage) {
                $tempDir = storage_path('app/temp');
                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0755, true);
                }
                
                $tempProcessedPath = $tempDir . '/' . $uuid . '.' . $extension;
                
                if (\App\Support\Media\ImageProcessor::process($originalTempPath, $tempProcessedPath, $extension)) {
                    $processedPath = $tempProcessedPath;
                    $dims = \App\Support\Media\ImageProcessor::getDimensions($processedPath);
                    $width = $dims['width'] ?? null;
                    $height = $dims['height'] ?? null;
                    $finalSize = filesize($processedPath);
                }
            }

            $path = $this->pathService->buildForModel(
                $owner::class,
                $uuid,
                $extension
            );

            $disk = $mediaData['disk'] ?? 'public';
            $directory = dirname($path);
            $filename = basename($path);

            Storage::disk($disk)->makeDirectory($directory);

            if ($processedPath) {
                // Store processed file
                $storedPath = Storage::disk($disk)->putFileAs($directory, new \Illuminate\Http\File($processedPath), $filename);
                // Clean up temp file
                if (file_exists($processedPath)) {
                    unlink($processedPath);
                }
            } else {
                // Fallback to original
                $storedPath = $file->storeAs($directory, $filename, [
                    'disk' => $disk,
                ]);
            }

            if ($storedPath === false || $storedPath === null) {
                throw new RuntimeException(sprintf(
                    'Media file could not be written to storage. disk=%s directory=%s filename=%s original=%s',
                    $disk,
                    $directory,
                    $filename,
                    $file->getClientOriginalName()
                ));
            }

            $media = Media::create([
                'uuid' => $uuid,
                'media_kind' => $mediaKind,
                'storage_type' => $mediaData['storage_type'] ?? 'file',
                'disk' => $disk,
                'path' => $storedPath,
                'original_name' => $file->getClientOriginalName(),
                'extension' => $extension,
                'mime_type' => $mimeType,
                'size' => $finalSize,
                'width' => $width,
                'height' => $height,
                'duration_seconds' => $mediaData['duration_seconds'] ?? null,
                'embed_provider' => $mediaData['embed_provider'] ?? null,
                'embed_url' => $mediaData['embed_url'] ?? null,
                'poster_path' => $mediaData['poster_path'] ?? null,
                'alt_text' => $mediaData['alt_text'] ?? null,
                'checksum' => $checksum,
                'is_active' => $mediaData['is_active'] ?? true,
                'created_by' => auth()->id() ?: null,
                'updated_by' => auth()->id() ?: null,
            ]);

            $owner->media()->attach($media->id, [
                'usage_type' => $pivotData['usage_type'] ?? 'gallery',
                'sort_order' => $pivotData['sort_order'] ?? 0,
                'is_primary' => $pivotData['is_primary'] ?? false,
                'title_override' => $pivotData['title_override'] ?? null,
                'caption' => $pivotData['caption'] ?? null,
                'credit' => $pivotData['credit'] ?? null,
                'notes' => $pivotData['notes'] ?? null,
            ]);

            // [NEW] Generate Derived Images (Thumb, WebP)
            \App\Support\Media\DerivedImageGenerator::generate($media);

            DB::commit();

            return $media;
        } catch (\Throwable $e) {
            DB::rollBack();

            if (isset($disk) && isset($path) && Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }

            throw $e;
        }
    }

    public function uploadManyForModel(
        Model $owner,
        array $files,
        array $mediaData = [],
        array $pivotData = []
    ): array {
        $uploaded = [];
        $sortOrder = (int) ($pivotData['sort_order'] ?? 0);

        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $uploaded[] = $this->uploadForModel(
                $owner,
                $file,
                $mediaData,
                array_merge($pivotData, [
                    'sort_order' => $sortOrder,
                    'is_primary' => false,
                ])
            );

            $sortOrder++;
        }

        return $uploaded;
    }

    public function replacePrimaryForModel(
        Model $owner,
        UploadedFile $file,
        string $usageType = 'cover',
        array $mediaData = [],
        array $pivotData = []
    ): Media {
        $existingIds = $owner->media()
            ->wherePivot('usage_type', $usageType)
            ->pluck('media.id')
            ->all();

        if (! empty($existingIds)) {
            $owner->media()->detach($existingIds);
        }

        return $this->uploadForModel(
            $owner,
            $file,
            $mediaData,
            array_merge($pivotData, [
                'usage_type' => $usageType,
                'is_primary' => true,
                'sort_order' => 0,
            ])
        );
    }

    public function detachFromModel(Model $owner, Media $media): void
    {
        $owner->media()->detach($media->id);
    }

    public function createEmbedForModel(
        Model $owner,
        array $mediaData = [],
        array $pivotData = []
    ): Media {
        DB::beginTransaction();

        try {
            $media = Media::create([
                'uuid' => (string) Str::uuid(),
                'media_kind' => $mediaData['media_kind'] ?? 'embed',
                'storage_type' => $mediaData['storage_type'] ?? 'external',
                'disk' => null,
                'path' => null,
                'original_name' => $mediaData['original_name'] ?? 'Embed Video',
                'extension' => null,
                'mime_type' => $mediaData['mime_type'] ?? null,
                'size' => null,
                'width' => $mediaData['width'] ?? null,
                'height' => $mediaData['height'] ?? null,
                'duration_seconds' => $mediaData['duration_seconds'] ?? null,
                'embed_provider' => $mediaData['embed_provider'] ?? null,
                'embed_url' => $mediaData['embed_url'] ?? null,
                'poster_path' => $mediaData['poster_path'] ?? null,
                'alt_text' => $mediaData['alt_text'] ?? null,
                'checksum' => null,
                'is_active' => $mediaData['is_active'] ?? true,
                'created_by' => auth()->id() ?: null,
                'updated_by' => auth()->id() ?: null,
            ]);

            $owner->media()->attach($media->id, [
                'usage_type' => $pivotData['usage_type'] ?? 'video',
                'sort_order' => $pivotData['sort_order'] ?? 0,
                'is_primary' => $pivotData['is_primary'] ?? false,
                'title_override' => $pivotData['title_override'] ?? null,
                'caption' => $pivotData['caption'] ?? null,
                'credit' => $pivotData['credit'] ?? null,
                'notes' => $pivotData['notes'] ?? null,
            ]);

            DB::commit();

            return $media;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}