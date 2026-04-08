<?php

namespace App\Policies;

use App\Models\User;

class OwnershipPolicy
{
    protected function isAdmin(User $user): bool
    {
        return $user->role === "admin" || $user->isSuperAdmin();
    }

    protected function isEditor(User $user): bool
    {
        return $user->role === "editor";
    }

    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor() || $user->isSuperAdmin();
    }

    public function view(User $user, mixed $model): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, mixed $model): bool
    {
        // 0. Demo Lock Guard
        if (method_exists($model, 'isDemo') && $model->isDemo()) {
            $identifier = $model->slug ?? (string) ($model->id ?? 'unknown');
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to UPDATE/DELETE demo record '{$identifier}' (".get_class($model).") by User ID: {$user->id}");
            return false;
        }

        if ($this->isAdmin($user)) {
            return true;
        }

        if ($this->isEditor($user) && method_exists($model, "isOwnedBy")) {
            return $model->isOwnedBy($user);
        }

        return false;
    }

    public function delete(User $user, mixed $model): bool
    {
        return $this->update($user, $model);
    }

    public function restore(User $user, mixed $model): bool
    {
        return $this->delete($user, $model);
    }

    public function forceDelete(User $user, mixed $model): bool
    {
        return $user->isSuperAdmin();
    }
}
