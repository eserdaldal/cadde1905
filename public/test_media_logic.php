<?php
use App\Models\Media;
use App\Support\Media\DerivedImageGenerator;
use App\Support\Media\ImageProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// Minimal Bootstrap
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    echo "--- Media Derivation Test ---\n";
    
    $testFile = __DIR__ . '/../test_upload_2.png';
    echo "Checking test file: " . realpath($testFile) . "\n";
    if (!file_exists($testFile)) {
        die("Missing test_upload_2.png at root. Path searched: " . $testFile . "\n");
    }
    echo "[PASS] Test file found.\n";

    $uuid = (string) Str::uuid();
    $ext = 'png';
    $disk = 'public';
    $targetDir = 'media/test/' . date('Y/m');
    $targetPath = $targetDir . '/' . $uuid . '.' . $ext;

    echo "Target Path: $targetPath\n";

    // 1. Process Large Image (Resize to 2400)
    Storage::disk($disk)->makeDirectory($targetDir);
    $fullTargetPath = Storage::disk($disk)->path($targetPath);
    
    echo "Processing image...\n";
    if (ImageProcessor::process($testFile, $fullTargetPath, $ext)) {
        echo "[PASS] ImageProcessor success\n";
    } else {
        echo "[FAIL] ImageProcessor failed\n";
    }

    // 2. Create Media record (Mock)
    $media = new Media([
        'uuid' => $uuid,
        'path' => $targetPath,
        'extension' => $ext,
        'media_kind' => 'image',
        'disk' => $disk,
    ]);
    
    // We don't necessarily need to save to DB for testing the generator logic 
    // but the generator expects a Media object.
    
    echo "Generating derivatives...\n";
    DerivedImageGenerator::generate($media);

    $derivedDir = $targetDir . '/derived';
    $thumbPath = $derivedDir . '/' . $uuid . '__thumb.' . $ext;
    $webpPath = $derivedDir . '/' . $uuid . '__webp.webp';

    if (Storage::disk($disk)->exists($thumbPath)) {
        echo "[PASS] Thumbnail created at: $thumbPath\n";
        echo "Thumb Size: " . Storage::disk($disk)->size($thumbPath) . "\n";
    } else {
        echo "[FAIL] Thumbnail missing!\n";
    }

    if (Storage::disk($disk)->exists($webpPath)) {
        echo "[PASS] WebP created at: $webpPath\n";
        echo "WebP Size: " . Storage::disk($disk)->size($webpPath) . "\n";
    } else {
        echo "[FAIL] WebP missing!\n";
    }

    echo "\nTest Complete.\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
