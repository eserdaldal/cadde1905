<?php

namespace App\Filament\Resources\MatchStadiumMapResource\Pages;

use App\Filament\Resources\MatchStadiumMapResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMatchStadiumMaps extends ManageRecords
{
    protected static string $resource = MatchStadiumMapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
