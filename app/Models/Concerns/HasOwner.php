<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait HasOwner
{
    protected static function bootHasOwner(): void
    {
        static::creating(function ($model) {
            // created_by boşsa ve login olunmuşsa otomatik doldur
            if (empty($model->created_by) && Auth::check()) {
                $model->created_by = Auth::id();
            }
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}