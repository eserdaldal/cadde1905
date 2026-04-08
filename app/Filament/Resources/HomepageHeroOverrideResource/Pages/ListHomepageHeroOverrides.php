<?php

namespace App\Filament\Resources\HomepageHeroOverrideResource\Pages;

use App\Filament\Resources\HomepageHeroOverrideResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomepageHeroOverrides extends ListRecords
{
    protected static string $resource = HomepageHeroOverrideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
