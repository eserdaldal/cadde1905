<?php

namespace App\Filament\Resources\HomepageHeroOverrideResource\Pages;

use App\Filament\Resources\HomepageHeroOverrideResource;
use App\Models\HomepageHeroOverride;
use App\Models\News;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CreateHomepageHeroOverride extends CreateRecord
{
    protected static string $resource = HomepageHeroOverrideResource::class;

    public function getTitle(): string
    {
        return 'Hero Ayarı Oluştur';
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $itemId = (int) ($data['item_id'] ?? 0);
        $startsAt = $data['starts_at'] ?? null;
        $endsAt = $data['ends_at'] ?? null;
        $isActive = (bool) ($data['is_active'] ?? false);

        $this->assertNewsIsPublished($itemId);
        $this->assertDateWindow($startsAt, $endsAt);

        if ($isActive) {
            $this->assertNoActiveConflict($startsAt, $endsAt);
        }

        $data['item_type'] = 'news';
        $data['content_key'] = 'news:' . $itemId;
        $data['created_by'] = Auth::id();

        return $data;
    }

    private function assertNewsIsPublished(int $itemId): void
    {
        $exists = News::query()
            ->whereKey($itemId)
            ->where('status', News::STATUS_PUBLISHED)
            ->whereNull('deleted_at')
            ->exists();

        if (! $exists) {
            Notification::make()
                ->title('Geçersiz içerik seçimi')
                ->body('Sadece yayındaki haberler hero override olarak seçilebilir.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'item_id' => 'Sadece yayındaki haberler hero override olarak seçilebilir.',
            ]);
        }
    }

    private function assertDateWindow(mixed $startsAt, mixed $endsAt): void
    {
        if (blank($endsAt)) {
            Notification::make()
                ->title('Bitiş zamanı zorunlu')
                ->body('Hero override için bitiş zamanı girilmelidir.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'ends_at' => 'Bitiş zamanı zorunludur.',
            ]);
        }

        if (filled($startsAt) && strtotime((string) $startsAt) >= strtotime((string) $endsAt)) {
            Notification::make()
                ->title('Geçersiz zaman aralığı')
                ->body('Bitiş zamanı başlangıç zamanından sonra olmalıdır.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'ends_at' => 'Bitiş zamanı başlangıç zamanından sonra olmalıdır.',
            ]);
        }
    }

    private function assertNoActiveConflict(mixed $startsAt, mixed $endsAt): void
    {
        $query = HomepageHeroOverride::query()
            ->where('is_active', true);

        if (filled($startsAt)) {
            $query->where(function ($q) use ($startsAt): void {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>', $startsAt);
            });
        }

        if (filled($endsAt)) {
            $query->where(function ($q) use ($endsAt): void {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '<', $endsAt);
            });
        }

        if ($query->exists()) {
            Notification::make()
                ->title('Aktif hero çakışması')
                ->body('Bu zaman aralığında zaten aktif bir hero override kaydı var. Aynı anda yalnızca bir aktif override olabilir.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'is_active' => 'Bu zaman aralığında zaten aktif bir hero override kaydı var. Aynı anda yalnızca bir aktif override olabilir.',
            ]);
        }
    }
}
