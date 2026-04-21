<?php
header('Content-Type: text/plain');
$dir = __DIR__ . '/../storage/app/public/media/';
echo "Listing contents of: $dir\n";

function listDir($path) {
    if (!is_dir($path)) {
        echo "Dir not found: $path\n";
        return;
    }
    $files = scandir($path);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $full = $path . '/' . $file;
        if (is_dir($full)) {
            echo "[DIR] $file\n";
            listDir($full);
        } else {
            echo "[FILE] $file (" . filesize($full) . " bytes)\n";
        }
    }
}

listDir($dir);
