<?php

namespace App\Filament\Resources\LegendResource\Pages;

use App\Filament\Resources\LegendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegends extends ListRecords
{
    protected static string $resource = LegendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
