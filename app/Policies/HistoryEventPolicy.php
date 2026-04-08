<?php

namespace App\Policies;

use App\Models\HistoryEvent;
use App\Models\User;

class HistoryEventPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ["admin", "editor"]);
    }

    public function view(User $user, HistoryEvent $historyEvent): bool
    {
        return in_array($user->role, ["admin", "editor"]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ["admin", "editor"]);
    }

    public function update(User $user, HistoryEvent $historyEvent): bool
    {
        if (method_exists($historyEvent, 'isDemo') && $historyEvent->isDemo()) {
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to UPDATE demo history event '{$historyEvent->slug}' by User ID: {$user->id}");
            return false;
        }

        return in_array($user->role, ["admin", "editor"]);
    }

    public function delete(User $user, HistoryEvent $historyEvent): bool
    {
        if (method_exists($historyEvent, 'isDemo') && $historyEvent->isDemo()) {
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to DELETE demo history event '{$historyEvent->slug}' by User ID: {$user->id}");
            return false;
        }

        return $user->role === "admin";
    }

    public function restore(User $user, HistoryEvent $historyEvent): bool
    {
        if (method_exists($historyEvent, 'isDemo') && $historyEvent->isDemo()) {
            return false;
        }

        return $user->role === "admin";
    }

    public function forceDelete(User $user, HistoryEvent $historyEvent): bool
    {
        if (method_exists($historyEvent, 'isDemo') && $historyEvent->isDemo()) {
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to FORCE DELETE demo history event '{$historyEvent->slug}' by User ID: {$user->id}");
            return false;
        }

        return $user->role === "admin";
    }
}
