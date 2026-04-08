<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;

class NewsPolicy
{
    /**
     * Admin/SuperAdmin her şeyi yapabilsin.
     */
    public function before(User $user, string $ability): ?bool
    {
        // 1. Destructive/Modifying actions: 'before' MUST return null
        // to force the evaluation of specific methods (update, delete, etc.)
        // even for SuperAdmins. This is the core of the Demo Lock.
        $blockedAbilities = ['update', 'delete', 'restore', 'forceDelete', 'publish', 'revoke', 'sendToReview'];
        
        if (in_array($ability, $blockedAbilities, true)) {
            return null;
        }

        // 2. Otherwise: Admin/SuperAdmin passes usually.
        if ($user->role === 'admin' || $user->isSuperAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Editor listeyi görebilir.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'editor';
    }

    /**
     * Editor tekil kaydı görebilir.
     */
    public function view(User $user, News $news): bool
    {
        return $user->role === 'editor';
    }

    public function create(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function update(User $user, News $news): bool
    {
        // 0. Demo Lock Guard
        if ($news->isDemo()) {
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to UPDATE demo news '{$news->slug}' by User ID: {$user->id}");
            return false;
        }

        // 1. Ownership: Editör sadece kendi haberine dokunabilir.
        if ($user->isEditor() && (int) $news->author_user_id !== (int) $user->id) {
            return false;
        }

        // 2. State Check: Editör sadece DRAFT durumundaysa GÜNCELLEYEBİLİR (Form Edit).
        // Eğer bir adminse zaten 'before' metodundan true döner.
        if ($user->isEditor() && $news->status !== News::STATUS_DRAFT) {
            return false;
        }

        return true;
    }

    /**
     * Yayına Alma Yetkisi
     */
    public function publish(User $user, News $news): bool
    {
        return $news->canTransitionTo(News::STATUS_PUBLISHED, $user);
    }

    /**
     * Onaya Gönderma Yetkisi
     */
    public function sendToReview(User $user, News $news): bool
    {
        return $news->canTransitionTo(News::STATUS_IN_REVIEW, $user);
    }

    /**
     * Taslağa Çekme Yetkisi (Revoke)
     */
    public function revoke(User $user, News $news): bool
    {
        return $news->canTransitionTo(News::STATUS_DRAFT, $user);
    }

    /**
     * Editor sadece KENDİ DRAFT'ını silebilir.
     */
    public function delete(User $user, News $news): bool
    {
        // 0. Demo Lock Guard
        if ($news->isDemo()) {
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to DELETE demo news '{$news->slug}' by User ID: {$user->id}");
            return false;
        }

        if ($user->isEditor()) {
            return (int) $news->author_user_id === (int) $user->id && $news->isDraft();
        }

        return true; // Admin/Superadmin 'before' dan geçer ama double check.
    }

    /**
     * Bulk delete için.
     */
    public function deleteAny(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Soft delete geri alma.
     */
    public function restore(User $user, News $news): bool
    {
        // 0. Demo Lock Guard
        if ($news->isDemo()) {
            return false;
        }

        return $user->isAdmin() || $user->isSuperAdmin();
    }

    public function restoreAny(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    /**
     * Kalıcı silme.
     */
    public function forceDelete(User $user, News $news): bool
    {
        // 0. Demo Lock Guard
        if ($news->isDemo()) {
            \Illuminate\Support\Facades\Log::warning("Demo Lock: Attempted to FORCE DELETE demo news '{$news->slug}' by User ID: {$user->id}");
            return false;
        }

        return $user->isSuperAdmin();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Replicate: Şimdilik kapalı kalsın.
     */
    public function replicate(User $user, News $news): bool
    {
        return false;
    }
}