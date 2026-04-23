<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Concerns\HasDemoLock;

class News extends Model
{
    use SoftDeletes, HasDemoLock, \App\Models\Concerns\HasTags;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_IN_REVIEW = 'in_review';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'category_id',
        'author_user_id',
        'branch',
        'title',
        'slug',
        'summary',
        'content',
        'source_url',
        'status',
        'published_at',
        'is_ai_generated',
        'hero_eligible',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_ai_generated' => 'boolean',
        'hero_eligible' => 'boolean',
    ];

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isInReview(): bool
    {
        return $this->status === self::STATUS_IN_REVIEW;
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    // Unified via HasTags

    public function media(): MorphToMany
    {
        return $this->morphToMany(
            Media::class,
            'mediable',
            'mediaables'
        )->withPivot([
            'usage_type',
            'sort_order',
            'is_primary',
            'title_override',
            'caption',
            'credit',
            'notes',
            'watermark_enabled',
        ])->withTimestamps();
    }

    public function coverMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'cover');
    }

    public function galleryMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'gallery');
    }

    public function videoMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'video');
    }

    public function primaryCover()
    {
        return $this->media()
            ->wherePivot('usage_type', 'cover')
            ->wherePivot('is_primary', true)
            ->orderByDesc('mediaables.id');
    }

    /**
     * Centralized method to get the news cover URL.
     * Fallback Chain: WM (if enabled & exists) -> Original -> Placeholder.
     */
    public function coverImageUrl(): string
    {
        $media = $this->primaryCover()->first();
        $placeholder = '/images/placeholders/news-placeholder.webp';

        if (! $media || empty($media->path)) {
            return $placeholder;
        }

        $disk = $media->disk ?: 'public';
        $path = $media->path;

        // Watermark check
        if ($media->pivot->watermark_enabled) {
            $dir = dirname($path);
            $uuid = $media->uuid;
            $extension = $media->extension;
            
            // Expected watermark path: derived/uuid__wm.ext
            $wmPath = $dir . '/derived/' . $uuid . '__wm.' . $extension;

            // Check physical presence for safety (first fallback tier)
            if (\Illuminate\Support\Facades\Storage::disk($disk)->exists($wmPath)) {
                return '/storage/' . ltrim($wmPath, '/');
            }
            
            // If wm path doesn't match extension, try .webp as fallback (WatermarkGenerator might force it)
            $wmWebpPath = $dir . '/derived/' . $uuid . '__wm.webp';
            if (\Illuminate\Support\Facades\Storage::disk($disk)->exists($wmWebpPath)) {
                return '/storage/' . ltrim($wmWebpPath, '/');
            }
        }

        // Tier 2: Original
        return '/storage/' . ltrim($path, '/');
    }

    /**
     * Get the news cover thumbnail URL.
     * Fallback Chain: WebP Thumbnail -> Original Ext Thumbnail -> Real Cover (WM/Original) -> Placeholder.
     */
    public function coverThumbUrl(): string
    {
        $media = $this->primaryCover()->first();

        // If no media, use coverImageUrl() which handles placeholder logic
        if (! $media || empty($media->path)) {
            return $this->coverImageUrl();
        }

        $disk = $media->disk ?: 'public';
        $path = $media->path;
        $dir = dirname($path);
        $uuid = $media->uuid;
        
        // Tier 1: WebP Thumbnail Preference
        $thumbWebpPath = $dir . '/derived/' . $uuid . '__thumb.webp';
        if (\Illuminate\Support\Facades\Storage::disk($disk)->exists($thumbWebpPath)) {
            return '/storage/' . ltrim($thumbWebpPath, '/');
        }

        // Tier 2: Original Extension Thumbnail
        $thumbPath = $dir . '/derived/' . $uuid . '__thumb.' . $media->extension;
        if (\Illuminate\Support\Facades\Storage::disk($disk)->exists($thumbPath)) {
            return '/storage/' . ltrim($thumbPath, '/');
        }

        // Tier 3: Full Cover (Watermarked or Original)
        return $this->coverImageUrl();
    }

    /**
     * Get the news cover srcset for responsive images.
     * Combines Thumb (640w) and Full (2000w).
     */
    public function coverSrcset(): string
    {
        return $this->coverThumbUrl() . ' 640w, ' . $this->coverImageUrl() . ' 2000w';
    }

    public function getListExcerptAttribute(): string
    {
        $text = trim((string) ($this->summary ?: strip_tags((string) $this->content)));

        if ($text === '') {
            return '';
        }

        return mb_strimwidth($text, 0, 180, '...');
    }

    /**
     * Merkezi Geçiş Mantığı (Single Source of Truth)
     * Bu metot, bir haberin belirli bir statüye geçip geçemeyeceğini kurallara göre belirler.
     */
    public function canTransitionTo(string $targetStatus, ?User $user = null): bool
    {
        // 1. Eğer hedef statü şu ankiyle aynıysa izin ver
        if ($targetStatus === $this->status) {
            return true;
        }

        // 2. Geçersiz statü kontolü
        if (! in_array($targetStatus, [self::STATUS_DRAFT, self::STATUS_IN_REVIEW, self::STATUS_PUBLISHED])) {
            return false;
        }

        // 3. Kullanıcı yoksa (Sistem/CLI) kuralı bypass et veya varsayılan izin ver
        if (! $user) {
            return true;
        }

        // 4. SuperAdmin her şeyi yapabilir
        if ($user->isSuperAdmin()) {
            return true;
        }

        // 5. EDITOR Kısıtları
        if ($user->isEditor()) {
            // Editor asla direkt 'published' yapamaz
            if ($targetStatus === self::STATUS_PUBLISHED) {
                return false;
            }
            // Editor sadece DRAFT'tan IN_REVIEW'a geçiş yapabilir
            return $this->status === self::STATUS_DRAFT && $targetStatus === self::STATUS_IN_REVIEW;
        }

        // 6. ADMIN Kısıtları
        if ($user->isAdmin()) {
            // Admin her geçişe izinli (Workflow gereği Draft -> Published veya InReview -> Published yapabilir)
            return true;
        }

        return false;
    }

    protected static function booted(): void
    {
        static::saving(function (News $news) {
            // 1. Automatize published_at
            if ($news->status === self::STATUS_PUBLISHED && empty($news->published_at)) {
                $news->published_at = now();
            }

            if ($news->status !== self::STATUS_PUBLISHED) {
                $news->published_at = null;
            }

            // 2. Transition Guards (Security Hardening)
            // Sadece auth olan web kullanıcıları için sert kontrol uygula
            if (auth()->check() && ! app()->runningInConsole() && $news->isDirty('status')) {
                $user = auth()->user();
                $targetStatus = $news->status;

                if (! $news->canTransitionTo($targetStatus, $user)) {
                    // Web context'te olduğumuz için güvenle abort edebiliriz veya loglayabiliriz.
                    // Bu son savunma hattıdır.
                    logger()->warning('Unauthorized news status transition attempt detected.', [
                        'user_id' => $user->id,
                        'news_id' => $news->id,
                        'from' => $news->getOriginal('status'),
                        'to' => $targetStatus,
                    ]);

                    abort(403, 'Bu statü geçişi için yetkiniz bulunmuyor.');
                }
            }
        });
    }
}
