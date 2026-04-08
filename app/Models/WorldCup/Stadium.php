<?php

namespace App\Models\WorldCup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Stadium extends Model
{
    protected $table = 'world_cup_stadiums';

    protected $fillable = [
        'tournament_id',
        'external_id',
        'name_api',
        'name_override',
        'slug',
        'city_api',
        'country_api',
        'capacity',
        'latitude',
        'longitude',
        'image_override',
        'description_editorial',
        'is_featured',
        'is_visible',
        // FAZ 9 Fields
        'description',
        'hero_image',
        'seating_plan_image',
        'gallery',
        'address',
        'opened_year',
        'surface_type',
        'capacity_override',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'gallery' => 'json',
    ];

    protected static function booted()
    {
        static::saving(function (Stadium $stadium) {
            // Eğer slug manuel doldurulmadıysa veya isim değiştiyse yeniden üret
            $name = $stadium->name_override ?: $stadium->name_api;
            
            if (empty($stadium->slug) || $stadium->isDirty(['name_override', 'name_api'])) {
                $stadium->slug = static::generateUniqueSlug($name, $stadium->id);
            }
        });
    }

    private static function generateUniqueSlug(string $name, $currentId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($currentId, fn($q) => $q->where('id', '!=', $currentId))->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getDisplayCapacityAttribute(): ?int
    {
        return $this->capacity_override ?: $this->capacity;
    }

    public function worldCup(): BelongsTo
    {
        return $this->belongsTo(WorldCup::class, 'tournament_id');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(WorldCupMatch::class, 'stadium_id');
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(StadiumAlias::class, 'stadium_id');
    }
}
