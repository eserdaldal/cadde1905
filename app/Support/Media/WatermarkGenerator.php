<?php

namespace App\Support\Media;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class WatermarkGenerator
{
    /**
     * Generates a watermarked version of the media.
     * Saved to: derived/uuid__wm.ext
     */
    public static function generate(Media $media): bool
    {
        if ($media->media_kind !== 'image') {
            return false;
        }

        $extension = strtolower($media->extension);
        $safeRasterExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $safeRasterExtensions)) {
            return false;
        }

        $disk = $media->disk ?? 'public';
        $originalPath = $media->path;

        if (!Storage::disk($disk)->exists($originalPath)) {
            return false;
        }

        // Branding asset
        $watermarkSource = storage_path('app/branding/watermark.png');
        if (!file_exists($watermarkSource)) {
            \Log::warning("Watermark source not found: " . $watermarkSource);
            return false;
        }

        $originalFullPath = Storage::disk($disk)->path($originalPath);
        $directory = dirname($originalPath);
        $uuid = $media->uuid;

        // Derived subfolder
        $derivedDir = $directory . '/derived';
        if (!Storage::disk($disk)->exists($derivedDir)) {
            Storage::disk($disk)->makeDirectory($derivedDir);
        }

        $wmName = sprintf('%s__wm.%s', $uuid, $extension);
        $wmPath = $derivedDir . '/' . $wmName;
        $wmFullPath = Storage::disk($disk)->path($wmPath);

        return self::applyWatermark($originalFullPath, $wmFullPath, $watermarkSource, $extension);
    }

    protected static function applyWatermark(string $inputPath, string $outputPath, string $wmSource, string $ext): bool
    {
        $base = self::createImage($inputPath, $ext);
        $watermark = @imagecreatefrompng($wmSource);

        if (!$base || !$watermark) {
            if ($base) imagedestroy($base);
            if ($watermark) imagedestroy($watermark);
            return false;
        }

        // Image dimensions
        $baseW = imagesx($base);
        $baseH = imagesy($base);
        $wmW = imagesx($watermark);
        $wmH = imagesy($watermark);

        // Scale watermark if it's too big (max 25% of the base image width)
        $maxWmW = (int) ($baseW * 0.25);
        if ($wmW > $maxWmW) {
            $ratio = $maxWmW / $wmW;
            $newWmW = $maxWmW;
            $newWmH = (int) ($wmH * $ratio);
            
            $scaledWm = imagecreatetruecolor($newWmW, $newWmH);
            imagealphablending($scaledWm, false);
            imagesavealpha($scaledWm, true);
            imagecopyresampled($scaledWm, $watermark, 0, 0, 0, 0, $newWmW, $newWmH, $wmW, $wmH);
            
            imagedestroy($watermark);
            $watermark = $scaledWm;
            $wmW = $newWmW;
            $wmH = $newWmH;
        }

        // Calculate position (Bottom Right with 20px padding)
        $padding = 20;
        $destX = $baseW - $wmW - $padding;
        $destY = $baseH - $wmH - $padding;

        // Apply watermark
        imagealphablending($base, true);
        imagecopy($base, $watermark, $destX, $destY, 0, 0, $wmW, $wmH);

        // Save
        $result = self::saveImage($base, $outputPath, $ext);

        imagedestroy($base);
        imagedestroy($watermark);

        return $result;
    }

    protected static function createImage(string $path, string &$ext)
    {
        $info = @getimagesize($path);
        if (!$info) return null;

        $mime = $info['mime'];
        
        return match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($path),
            'image/png' => @imagecreatefrompng($path),
            'image/webp' => @imagecreatefromwebp($path),
            default => null,
        };
    }

    protected static function saveImage($img, string $path, string $ext): bool
    {
        $ext = strtolower($ext);
        return match ($ext) {
            'jpg', 'jpeg' => imagejpeg($img, $path, 90),
            'png' => imagepng($img, $path, 5),
            'webp' => imagewebp($img, $path, 85),
            default => false,
        };
    }
}
