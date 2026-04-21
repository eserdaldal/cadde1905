<?php

namespace App\Support\Media;

use RuntimeException;
use Illuminate\Support\Facades\Log;

class ImageProcessor
{
    /**
     * Resizes and optimizes an image.
     * 
     * @param string $inputPath Path to original file
     * @param string $outputPath Path to save processed file
     * @param string $extension File extension (fallback/intended)
     * @return bool Success status
     */
    public static function process(string $inputPath, string $outputPath, string $extension): bool
    {
        try {
            $img = self::createImage($inputPath);
            
            if (!$img) {
                Log::warning('ImageProcessor: Failed to create image resource from ' . $inputPath);
                return false;
            }

            $width = imagesx($img);
            $height = imagesy($img);

            // Resize parameters
            $maxW = 2400;
            $maxH = 2400;

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

                // Handle transparency for PNG/WebP
                // Detect type again for safety
                $info = @getimagesize($inputPath);
                $mime = $info['mime'] ?? '';
                
                if (str_contains($mime, 'png') || str_contains($mime, 'webp')) {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                    imagefilledrectangle($resized, 0, 0, $newW, $newH, $transparent);
                }

                imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $width, $height);
                imagedestroy($img);
                $img = $resized;
            }

            // Save optimized image
            $success = self::saveImage($img, $outputPath, $extension);
            imagedestroy($img);

            if ($success && file_exists($outputPath)) {
                $size = filesize($outputPath);
                if ($size < 1024) {
                    Log::warning('ImageProcessor: Processed image is abnormally small (' . $size . ' bytes). Cleanup triggered.', ['path' => $outputPath]);
                    @unlink($outputPath);
                    return false;
                }
                return true;
            }

            return false;
        } catch (\Throwable $e) {
            Log::warning('ImageProcessor: Error during processing: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Returns dimensions of an image.
     */
    public static function getDimensions(string $path): ?array
    {
        $info = @getimagesize($path);
        if (!$info) {
            return null;
        }
        return [
            'width' => $info[0],
            'height' => $info[1],
        ];
    }

    protected static function createImage(string $path)
    {
        $info = @getimagesize($path);
        if (!$info) {
            return null;
        }

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
            in_array($ext, ['jpg', 'jpeg']) => @imagejpeg($img, $path, 82),
            $ext === 'png' => @imagepng($img, $path, 6),
            $ext === 'webp' => @imagewebp($img, $path, 82),
            default => false,
        };
    }
}
