<?php

namespace App\Filament\Resources\HomepageHeroOverrideResource\Pages;

use App\Filament\Resources\HomepageHeroOverrideResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomepageHeroOverride extends EditRecord
{
    protected static string $resource = HomepageHeroOverrideResource::class;

    public function getTitle(): string
    {
        return 'Hero Ayarını Düzenle';
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
