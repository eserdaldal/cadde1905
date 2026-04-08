<?php

namespace App\Filament\Resources\TimelineEntryResource\Pages;

use App\Filament\Resources\TimelineEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimelineEntries extends ListRecords
{
    protected static string $resource = TimelineEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}