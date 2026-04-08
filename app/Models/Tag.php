<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
    ];

    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable', 'taggables')->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_tag');
    }
}
