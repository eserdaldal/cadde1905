<?php

namespace App\Models\Concerns;

use App\Services\SiteModeService;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasDemoLock
 *
 * AŞAMA 3 — Demo Governance: Slug registry tabanlı lock sistemi devre dışı bırakıldı.
 * is_demo alanı artık tek gerçek kaynak. edit/delete hakları artık kısıtlanmıyor.
 *
 * @deprecated-lock Slug registry artık kullanılmıyor.
 */
trait HasDemoLock
{
    /**
     * Global Scope: Live Mode İzolasyonu
     *
     * Eğer site Live moddaysa ve istek admin panelinden gelmiyorsa,
     * sadece is_demo = 0 olan kayıtları döndürür.
     */
    protected static function bootHasDemoLock(): void
    {
        static::addGlobalScope('live_mode_isolation', function (Builder $builder) {
            // Sadece Live modda ve Admin tarafında değilsek izole et
            if (SiteModeService::isLive() && !request()->is('admin*')) {
                $builder->where('is_demo', 0);
            }
        });
    }

    /**
     * Her zaman false döner — lock sistemi kaldırıldı.
     * is_demo DB alanı yönetimi artık query katmanında yapılır.
     */
    public function isDemo(): bool
    {
        return false;
    }

    /**
     * @deprecated
     */
    public function isLocked(): bool
    {
        return false;
    }
}
