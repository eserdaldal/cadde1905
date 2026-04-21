<?php

namespace App\Support\Media;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DerivedImageGenerator
{
    /**
     * Generates thumbnail and WebP versions for a given Media record.
     * Only works for raster images.
     */
    public static function generate(Media $media): void
    {
        if ($media->media_kind !== 'image') {
            return;
        }

        $disk = $media->disk ?? 'public';
        $originalPath = $media->path;

        if (!Storage::disk($disk)->exists($originalPath)) {
            return;
        }

        $info = @getimagesize(Storage::disk($disk)->path($originalPath));
        if (!$info || !in_array($info[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP])) {
            Log::warning('DerivedImageGenerator: Skipping unsupported or invalid image type for media uuid: ' . $media->uuid);
            return;
        }

        $originalFullPath = Storage::disk($disk)->path($originalPath);
        $directory = dirname($originalPath);
        $uuid = $media->uuid;
        $extension = strtolower($media->extension);

        // Derived subfolder path
        $derivedDir = $directory . '/derived';
        Storage::disk($disk)->makeDirectory($derivedDir);

        // 1. Standard Thumbnail (Original Extension)
        $thumbName = sprintf('%s__thumb.%s', $uuid, $extension);
        $thumbPath = $derivedDir . '/' . $thumbName;
        self::safeGenerateThumbnail($originalFullPath, Storage::disk($disk)->path($thumbPath), $extension);

        // 2. WebP Thumbnail (Fail-safe & Smart)
        if ($extension !== 'webp') {
            try {
                $thumbWebpName = sprintf('%s__thumb.webp', $uuid);
                $thumbWebpPath = $derivedDir . '/' . $thumbWebpName;
                self::safeGenerateThumbnail($originalFullPath, Storage::disk($disk)->path($thumbWebpPath), 'webp');
            } catch (\Throwable $e) {
                Log::warning('DerivedImageGenerator: WebP thumbnail generation failed for uuid: ' . $uuid . ' - ' . $e->getMessage());
            }
        }

        // 3. Full WebP
        if ($extension !== 'webp') {
            try {
                $webpName = sprintf('%s__webp.webp', $uuid);
                $webpPath = $derivedDir . '/' . $webpName;
                self::safeGenerateWebP($originalFullPath, Storage::disk($disk)->path($webpPath));
            } catch (\Throwable $e) {
                Log::warning('DerivedImageGenerator: Full WebP generation failed for uuid: ' . $uuid . ' - ' . $e->getMessage());
            }
        }
    }

    protected static function safeGenerateThumbnail(string $inputPath, string $outputPath, string $targetExt): void
    {
        $img = self::createImage($inputPath);
        if (!$img) return;

        $width = imagesx($img);
        $height = imagesy($img);

        $maxW = 640;
        $maxH = 640;

        if ($width > $maxW || $height > $maxH) {
            $ratio = $width / $height;
            if ($width / $maxW > $height / $maxH) {
                $newW = $maxW;
                $newH = (int) round($maxW / $ratio);
            } else {
                $newH = $maxH;
                $newW = (int) round($maxH * $ratio);
            }

            $resized = imagecreatetruecolor($newW, $newH);

            // Preserve transparency
            $info = @getimagesize($inputPath);
            if (($info && in_array($info[2], [IMAGETYPE_PNG, IMAGETYPE_WEBP])) || $targetExt === 'webp') {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                imagefilledrectangle($resized, 0, 0, $newW, $newH, $transparent);
            }

            imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagedestroy($img);
            $img = $resized;
        }

        $success = self::saveImage($img, $outputPath, $targetExt);
        imagedestroy($img);

        if ($success && file_exists($outputPath)) {
            if (filesize($outputPath) < 1024) {
                Log::warning('DerivedImageGenerator: Thumbnail too small, deleting: ' . $outputPath);
                @unlink($outputPath);
            }
        }
    }

    protected static function safeGenerateWebP(string $inputPath, string $outputPath): void
    {
        $img = self::createImage($inputPath);
        if (!$img) return;

        imagealphablending($img, false);
        imagesavealpha($img, true);

        $success = @imagewebp($img, $outputPath, 82);
        imagedestroy($img);

        if ($success && file_exists($outputPath)) {
            if (filesize($outputPath) < 1024) {
                Log::warning('DerivedImageGenerator: Full WebP too small, deleting: ' . $outputPath);
                @unlink($outputPath);
            }
        }
    }

    protected static function createImage(string $path)
    {
        $info = @getimagesize($path);
        if (!$info) return null;

        return match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
            IMAGETYPE_PNG => @imagecreatefrompng($path),
            IMAGETYPE_WEBP => @imagecreatefromwebp($path),
            default => null,
        };
    }

    protected static function saveImage($img, string $path, string $ext): bool
    {
        $ext = strtolower($ext);
        return match (true) {
            in_array($ext, ['jpg', 'jpeg']) => @imagejpeg($img, $path, 80),
            $ext === 'png' => @imagepng($img, $path, 6),
            $ext === 'webp' => @imagewebp($img, $path, 82),
            default => false,
        };
    }
}
