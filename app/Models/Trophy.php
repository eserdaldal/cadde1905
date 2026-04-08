<?php

namespace App\Models;

use App\Models\Concerns\HasCoverMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use App\Models\Concerns\HasDemoLock;

class Trophy extends Model
{
    use HasCoverMedia, HasDemoLock, \App\Models\Concerns\HasTags;

    protected $fillable = [
        'name',
        'slug',
        'branch',
        'trophy_scope',
        'description',
        'content', // ✅ EKLENDİ
        'is_active',
        'sort_order',
    ];

    public function historyEvents(): BelongsToMany
    {
        return $this->belongsToMany(
            HistoryEvent::class,
            'history_event_trophy',
            'trophy_id',
            'history_event_id'
        )->withTimestamps();
    }

    protected function coverMediaAltText(): ?string
    {
        return $this->name;
    }

    // ✅ CONTENT MEDIA RELATION
    public function contentMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'content');
    }

    public function galleryMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'gallery');
    }

    public function videoMedia(): MorphToMany
    {
        return $this->media()->wherePivot('usage_type', 'video');
    }

    // ✅ CONTENT MEDIA SYNC
    public function syncContentMedia(array $paths): void
    {
        $mediaIds = [];

        foreach ($paths as $path) {
            $media = \App\Models\Media::firstOrCreate([
                'disk' => 'public',
                'path' => $path,
            ]);

            $mediaIds[$media->id] = [
                'usage_type' => 'content',
                'is_primary' => 0,
                'sort_order' => 0,
            ];
        }

        $this->contentMedia()->sync($mediaIds);
    }
}
