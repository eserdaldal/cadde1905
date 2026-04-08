<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait HasOwnership
{
    protected static function bootHasOwnership(): void
    {
        static::creating(function ($model) {
            if (empty($model->created_by) && Auth::check()) {
                $model->created_by = Auth::id();
            }
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, created_by);
    }

    public function isOwnedBy($user): bool
    {
        return (int) ($this->created_by ?? 0) === (int) ($user->id ?? 0);
    }
}
