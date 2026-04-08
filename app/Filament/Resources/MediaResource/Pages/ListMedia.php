<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use App\Services\Media\MediaUsageService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\View\View;

class ListMedia extends ListRecords
{
    protected static string $resource = MediaResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    public function getTitle(): string
    {
        return 'Medya Kütüphanesi';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cleanup_all_orphans')
                ->label('Tüm kullanılmayan medyaları temizle')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Tüm kullanılmayan medyalar silinsin mi?')
                ->modalDescription('Yalnızca hiçbir içerikte kullanılmayan medya kayıtları ve ilgili fiziksel dosyalar silinir.')
                ->action(function (): void {
                    /** @var MediaUsageService $usageService */
                    $usageService = app(MediaUsageService::class);

                    $result = $usageService->cleanupAllOrphans();

                    Notification::make()
                        ->title("Temizleme tamamlandı. Silinen: {$result['deleted']}, Atlanan: {$result['skipped']}")
                        ->success()
                        ->send();
                }),
        ];
    }

}