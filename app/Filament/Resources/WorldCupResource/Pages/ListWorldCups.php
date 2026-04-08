<?php

namespace App\Filament\Resources\WorldCupResource\Pages;

use App\Filament\Resources\WorldCupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorldCups extends ListRecords
{
    protected static string $resource = WorldCupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
