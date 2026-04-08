<?php

namespace App\Policies;

use App\Models\User;

class OwnedModelPolicy
{
    public function viewAny(User $user): bool
    {
        // Admin zaten Gate::before ile true döner.
        return in_array($user->role, ["admin", "editor"], true);
    }

    public function view(User $user, $model): bool
    {
        return in_array($user->role, ["admin", "editor"], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ["admin", "editor"], true);
    }

    public function update(User $user, $model): bool
    {
        // Editor sadece kendi kaydını update edebilir
        return (int) ($model->created_by ?? 0) === (int) $user->id;
    }

    public function delete(User $user, $model): bool
    {
        // Editor sadece kendi kaydını silebilir
        return (int) ($model->created_by ?? 0) === (int) $user->id;
    }

    public function restore(User $user, $model): bool
    {
        return (int) ($model->created_by ?? 0) === (int) $user->id;
    }

    public function forceDelete(User $user, $model): bool
    {
        return (int) ($model->created_by ?? 0) === (int) $user->id;
    }
}
