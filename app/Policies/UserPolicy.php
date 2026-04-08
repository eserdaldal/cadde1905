<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN || $user->isSuperAdmin();
    }

    public function view(User $user, User $model): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        if ($user->role === User::ROLE_ADMIN) {
            return true;
        }

        // Editor sadece kendini görür
        return $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN || $user->isSuperAdmin();
    }

    public function update(User $user, User $model): bool
    {
        // Superadmin: her şeyi günceller (protected hariç)
        if ($user->isSuperAdmin()) {
            if ($model->isProtectedAccount()) {
                return false;
            }
            return true;
        }

        // Admin: superadmin'e dokunamaz
        if ($user->role === User::ROLE_ADMIN) {
            if ($model->isSuperAdmin()) {
                return false;
            }
            if ($model->isProtectedAccount()) {
                return false;
            }
            return true;
        }

        // Editor: sadece kendini günceller
        return $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        // Kimse kendini silemesin
        if ($user->id === $model->id) {
            return false;
        }

        // Superadmin: silebilir (protected hariç)
        if ($user->isSuperAdmin()) {
            if ($model->isProtectedAccount()) {
                return false;
            }
            return true;
        }

        // Admin: superadmin'i ASLA silemez
        if ($user->role === User::ROLE_ADMIN) {
            if ($model->isSuperAdmin()) {
                return false;
            }
            if ($model->isProtectedAccount()) {
                return false;
            }
            return true;
        }

        // Editor: kimseyi silemez
        return false;
    }

    public function restore(User $user, User $model): bool
    {
        return $user->isSuperAdmin() || $user->role === User::ROLE_ADMIN;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $this->delete($user, $model);
    }
}