<?php

namespace App\Filament\Resources\SeasonArchiveResource\Pages;

use App\Filament\Resources\SeasonArchiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeasonArchives extends ListRecords
{
    protected static string $resource = SeasonArchiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
