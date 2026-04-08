<?php

namespace App\Filament\Resources\GroupStandingResource\Pages;

use App\Filament\Resources\GroupStandingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroupStandings extends ListRecords
{
    protected static string $resource = GroupStandingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
