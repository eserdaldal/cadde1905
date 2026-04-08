<?php

namespace App\Filament\Resources\SyncReviewResource\Pages;

use App\Filament\Resources\SyncReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSyncReviews extends ManageRecords
{
    protected static string $resource = SyncReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
