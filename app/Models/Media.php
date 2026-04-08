<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory, SoftDeletes;
 
    protected $table = 'media';
 
    protected static function booted(): void
    {
        static::creating(function (Media $media) {
            if (empty($media->uuid)) {
                $media->uuid = (string) \Illuminate\Support\Str::uuid();
            }
 
            if (empty($media->media_kind)) {
                $media->media_kind = 'image';
            }
 
            if (empty($media->storage_type)) {
                $media->storage_type = 'file';
            }
 
            if (! isset($media->is_active)) {
                $media->is_active = true;
            }

            if (empty($media->original_name) && ! empty($media->path)) {
                $media->original_name = basename($media->path);
            }
        });
    }
 
    protected $fillable = [
        'uuid',
        'media_kind',
        'storage_type',
        'disk',
        'path',
        'original_name',
        'mime_type',
        'extension',
        'size',
        'width',
        'height',
        'duration_seconds',
        'embed_provider',
        'embed_url',
        'poster_path',
        'alt_text',
        'checksum',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'size' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'url',
    ];

    public function usages(): HasMany
    {
        return $this->hasMany(Mediaable::class, 'media_id');
    }

    /**
     * Media URL accessor
     */
    public function getUrlAttribute(): ?string
    {
        if (!$this->path) {
            return null;
        }

        $disk = $this->disk ?: 'public';

        try {
            return Storage::disk($disk)->url($this->path);
        } catch (\Throwable $e) {
            return null;
        }
    }
}