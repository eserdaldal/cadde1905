<?php

namespace App\Models\Concerns;

/**
 * Trait HasDemoLock
 *
 * Demo içerik izolasyonu artık runtime seviyesinde uygulanmaz.
 * Görünürlük, ilgili publish/active alanlarıyla kontrol edilir.
 */
trait HasDemoLock
{
    /**
     * Demo görünürlüğü artık global scope ile yönetilmiyor.
     */
    protected static function bootHasDemoLock(): void
    {
        // intentionally empty
    }

    /**
     * Her zaman false döner — lock sistemi kaldırıldı.
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
