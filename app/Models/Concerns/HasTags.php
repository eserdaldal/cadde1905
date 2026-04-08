<?php

namespace App\Models\Concerns;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    /**
     * Unified tagging relationship.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggables')->withTimestamps();
    }

    /**
     * Helper to sync tags by names.
     */
    public function syncTagsByNames(array $names, string $type = 'general'): void
    {
        $tagIds = collect($names)->map(function ($name) use ($type) {
            $tag = Tag::firstOrCreate(
                ['name' => $name],
                ['slug' => \Illuminate\Support\Str::slug($name), 'type' => $type]
            );
            return $tag->id;
        });

        $this->tags()->sync($tagIds);
    }
}
