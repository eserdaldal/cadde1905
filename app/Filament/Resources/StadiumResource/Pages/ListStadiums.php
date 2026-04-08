<?php

namespace App\Filament\Resources\StadiumResource\Pages;

use App\Filament\Resources\StadiumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStadiums extends ListRecords
{
    protected static string $resource = StadiumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
