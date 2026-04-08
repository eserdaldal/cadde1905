<?php

namespace App\Filament\Resources\StadiumAliasResource\Pages;

use App\Filament\Resources\StadiumAliasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStadiumAliases extends ManageRecords
{
    protected static string $resource = StadiumAliasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
