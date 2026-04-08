<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;

class TagPolicy
{
    private function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }

    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function forceDelete(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }

    public function restore(User $user, Tag $tag): bool
    {
        return $this->isAdmin($user);
    }
}