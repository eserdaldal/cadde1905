<?php

namespace App\Filament\Resources\ContentRelationResource\Pages;

use App\Filament\Resources\ContentRelationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentRelations extends ListRecords
{
    protected static string $resource = ContentRelationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
