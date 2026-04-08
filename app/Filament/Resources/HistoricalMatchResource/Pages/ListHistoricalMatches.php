<?php

namespace App\Filament\Resources\HistoricalMatchResource\Pages;

use App\Filament\Resources\HistoricalMatchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoricalMatches extends ListRecords
{
    protected static string $resource = HistoricalMatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
