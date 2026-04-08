<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediaable extends Model
{
    use HasFactory;

    protected $table = 'mediaables';

    protected $fillable = [
        'media_id',
        'mediable_type',
        'mediable_id',
        'usage_type',
        'sort_order',
        'is_primary',
        'title_override',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
    ];
}