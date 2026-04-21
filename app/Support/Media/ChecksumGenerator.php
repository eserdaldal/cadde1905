<?php

namespace App\Support\Media;

use Illuminate\Http\UploadedFile;

class ChecksumGenerator
{
    /**
     * Generates a SHA-256 checksum for an uploaded file.
     *
     * @param UploadedFile $file
     * @return string
     */
    public static function generateForFile(UploadedFile $file): string
    {
        return hash_file('sha256', $file->getRealPath());
    }
}
